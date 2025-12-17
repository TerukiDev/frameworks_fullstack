<template>
    <MusicLayout>
        <template #title> Liste des playlists </template>

        <template #actions>
            <Button as-child>
                <Link :href="route('playlists.create')"
                    >Créer une playlist</Link
                >
            </Button>
        </template>

        <template #content>
            <div class="space-y-3">
                <Card
                    v-for="playlist in playlists"
                    :key="playlist.slug"
                    class="py-4 transition-colors hover:bg-muted/20 active:scale-[0.99]"
                >
                    <CardContent
                        class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
                    >
                        <div>
                            <div class="text-base font-semibold">
                                {{ playlist.title }}
                            </div>
                            <div class="text-sm text-muted-foreground">
                                {{ playlist.tracks_count }} musiques
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <Button as-child variant="outline">
                                <Link
                                    :href="
                                        route('playlists.edit', {
                                            playlist: playlist,
                                        })
                                    "
                                >
                                    Modifier
                                </Link>
                            </Button>
                            <Button as-child variant="destructive">
                                <Link
                                    :href="
                                        route('playlists.destroy', {
                                            playlist: playlist,
                                        })
                                    "
                                    method="delete"
                                    as="button"
                                >
                                    Supprimer
                                </Link>
                            </Button>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </template>
    </MusicLayout>
</template>

<script>
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import MusicLayout from '@/layouts/MusicLayout.vue';
import { Link } from '@inertiajs/vue3';

export default {
    name: 'Index',
    components: {
        Link,
        Button,
        Card,
        CardContent,
        MusicLayout,
    },
    props: {
        playlists: Array,
    },
};
</script>
