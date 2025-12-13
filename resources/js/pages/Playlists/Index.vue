<template>
    <MusicLayout>
        <template #title>
            Liste des playlists
        </template>

        <template #actions>
            <Link
                :href="route('playlists.create')"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                Créer une playlist
            </Link>
        </template>

        <template #content>
            <ul>
                <li
                    v-for="playlist in playlists"
                    :key="playlist.slug"
                >
                    {{ playlist.title }} <small>[{{ playlist.tracks_count }} musiques]</small>
                    <Link
                        :href="route('playlists.edit', { playlist: playlist })"
                        class="text-green-500"
                    >
                        Modifier
                    </Link>
                    <Link
                        :href="route('playlists.destroy', { playlist: playlist })"
                        method="delete"
                        as="button"
                        class="text-red-500"
                    >
                        Supprimer
                    </Link>
                </li>
            </ul>
        </template>
    </MusicLayout>
</template>

<script>
    import MusicLayout from '@/layouts/MusicLayout.vue';
    import { Link } from '@inertiajs/vue3';

    export default {
        name: 'Index',
        components: {
            Link,
            MusicLayout,
        },
        props: {
            playlists: Array,
        },
    }
</script>
