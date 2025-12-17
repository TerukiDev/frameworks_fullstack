<template>
    <MusicLayout>
        <template #title> Modifier une playlist </template>

        <template #actions>
            <Button as-child variant="outline">
                <Link :href="route('playlists.index')">Retour</Link>
            </Button>
        </template>

        <template #content>
            <PlaylistForm :playlist="playlist" :tracks="tracks" />
        </template>
    </MusicLayout>
</template>

<script>
import PlaylistForm from '@/components/Playlists/PlaylistForm.vue';
import Button from '@/components/ui/button/Button.vue';
import MusicLayout from '@/layouts/MusicLayout.vue';
import { Link } from '@inertiajs/vue3';

export default {
    name: 'Edit',
    components: {
        Link,
        Button,
        MusicLayout,
        PlaylistForm,
    },
    props: {
        playlist: Object,
        tracks: Array,
    },
};
</script>
