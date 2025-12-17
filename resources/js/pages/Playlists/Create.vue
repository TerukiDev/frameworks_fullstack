<template>
    <MusicLayout>
        <template #title> Créer une playlist </template>

        <template #actions>
            <Button as-child variant="outline">
                <Link :href="route('playlists.index')">Retour</Link>
            </Button>
        </template>

        <template #content>
            <PlaylistForm :tracks="tracks" />
        </template>
    </MusicLayout>
</template>

<script>
import PlaylistForm from '@/components/Playlists/PlaylistForm.vue';
import Button from '@/components/ui/button/Button.vue';
import MusicLayout from '@/layouts/MusicLayout.vue';
import { Link } from '@inertiajs/vue3';

export default {
    name: 'Create',
    components: {
        Link,
        Button,
        MusicLayout,
        PlaylistForm,
    },
    props: {
        tracks: Array,
    },
};
</script>
