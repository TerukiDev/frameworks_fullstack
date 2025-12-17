<template>
    <form @submit.prevent="submit">
        <Card>
            <CardContent class="space-y-5">
                <div class="space-y-2">
                    <Label for="title">Titre</Label>
                    <Input
                        id="title"
                        v-model="form.title"
                        type="text"
                        placeholder="Titre"
                        :aria-invalid="!!form.errors.title"
                    />
                    <InputError :message="form.errors.title" />
                </div>

                <div class="space-y-2">
                    <Label>Musiques</Label>

                    <div class="grid gap-2 sm:grid-cols-2">
                        <div v-for="track in tracks" :key="track.slug">
                            <input
                                :id="'tracks_' + track.slug"
                                v-model="form.tracks"
                                type="checkbox"
                                name="tracks"
                                :value="track.slug"
                                class="peer sr-only"
                            />
                            <label
                                :for="'tracks_' + track.slug"
                                class="flex cursor-pointer items-center justify-between gap-3 rounded-md border px-3 py-2 text-sm transition-colors peer-checked:border-primary peer-checked:bg-primary/10 hover:bg-muted/20"
                            >
                                <span class="line-clamp-1">{{
                                    track.title
                                }}</span>
                                <span
                                    class="text-xs text-primary opacity-0 transition-opacity peer-checked:opacity-100"
                                >
                                    Sélectionné
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <Button :disabled="form.processing">
                        {{
                            playlist
                                ? 'Modifier la playlist'
                                : 'Créer la playlist'
                        }}
                    </Button>
                </div>
            </CardContent>
        </Card>
    </form>
</template>

<script>
import InputError from '@/components/InputError.vue';
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';

export default {
    name: 'PlaylistForm',
    components: {
        Button,
        Card,
        CardContent,
        Input,
        InputError,
        Label,
    },
    props: {
        playlist: Object,
        tracks: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                title: this.playlist?.title ?? '',
                tracks: this.playlist?.tracks?.map((track) => track.slug) ?? [],
            }),
        };
    },
    methods: {
        submit() {
            if (this.playlist) {
                this.form.put(
                    route('playlists.update', { playlist: this.playlist }),
                );
            } else {
                this.form.post(route('playlists.store'));
            }
        },
    },
};
</script>
