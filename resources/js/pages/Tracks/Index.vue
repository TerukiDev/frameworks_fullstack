<template>
    <MusicLayout>
        <template #title> Liste des musiques </template>

        <template #actions>
            <Button v-if="$page.props.isAdmin" as-child>
                <Link :href="route('tracks.create')">Créer une musique</Link>
            </Button>
        </template>

        <template #content>
            <div class="mb-5 max-w-md">
                <Input
                    id="search"
                    v-model="search"
                    type="search"
                    name="search"
                    placeholder="Rechercher..."
                />
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <Track
                    v-for="track in filteredTracks"
                    :key="track.slug"
                    :track="track"
                    @listen="handleListen"
                />
            </div>
        </template>
    </MusicLayout>
</template>

<script>
import Track from '@/components/Tracks/Track.vue';
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import MusicLayout from '@/layouts/MusicLayout.vue';
import { Link } from '@inertiajs/vue3';

export default {
    name: 'Index',
    components: {
        Link,
        Button,
        Input,
        MusicLayout,
        Track,
    },
    props: {
        tracks: Array,
    },
    data() {
        return {
            audio: null,
            currentAudio: null,
            search: '',
        };
    },
    computed: {
        filteredTracks() {
            return this.tracks.filter((track) =>
                track.title.toLowerCase().includes(this.search.toLowerCase()),
            );
        },
    },
    methods: {
        changeCurrentAudio(track) {
            this.audio = new Audio('/storage/' + track.audio);
            this.audio.play();
            this.currentAudio = track.slug;
        },
        handleListen(track) {
            if (!this.audio) {
                this.changeCurrentAudio(track);
            } else if (track.slug !== this.currentAudio) {
                this.audio.pause();
                this.changeCurrentAudio(track);
            } else if (this.audio.paused) {
                this.audio.play();
            } else {
                this.audio.pause();
            }
        },
    },
};
</script>
