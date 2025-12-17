<template>
    <MusicLayout>
        <template #title> Créer une musique </template>

        <template #actions>
            <Button as-child variant="outline">
                <Link :href="route('tracks.index')">Retour</Link>
            </Button>
        </template>

        <template #content>
            <Card class="max-w-xl">
                <CardHeader>
                    <CardTitle>Nouvelle musique</CardTitle>
                    <CardDescription>
                        Renseigne le titre, l'artiste, une image et un fichier
                        audio.
                    </CardDescription>
                </CardHeader>
                <CardContent class="space-y-5">
                    <form @submit.prevent="submit" class="space-y-5">
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
                            <Label for="artist">Artiste</Label>
                            <Input
                                id="artist"
                                v-model="form.artist"
                                type="text"
                                placeholder="Artiste"
                                :aria-invalid="!!form.errors.artist"
                            />
                            <InputError :message="form.errors.artist" />
                        </div>

                        <div class="space-y-2">
                            <Label for="image">Image</Label>
                            <Input
                                id="image"
                                type="file"
                                class="cursor-pointer"
                                @change="form.image = $event.target.files[0]"
                            />
                            <InputError :message="form.errors.image" />
                        </div>

                        <div class="space-y-2">
                            <Label for="audio">Audio</Label>
                            <Input
                                id="audio"
                                type="file"
                                class="cursor-pointer"
                                @change="form.audio = $event.target.files[0]"
                            />
                            <InputError :message="form.errors.audio" />
                        </div>

                        <div class="flex items-center gap-3">
                            <Button :disabled="form.processing"
                                >Créer la musique</Button
                            >
                        </div>
                    </form>
                </CardContent>
            </Card>
        </template>
    </MusicLayout>
</template>

<script>
import InputError from '@/components/InputError.vue';
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import MusicLayout from '@/layouts/MusicLayout.vue';
import { Link } from '@inertiajs/vue3';

export default {
    name: 'Create',
    components: {
        Link,
        Button,
        Card,
        CardDescription,
        CardContent,
        CardHeader,
        CardTitle,
        Input,
        InputError,
        Label,
        MusicLayout,
    },
    data() {
        return {
            form: this.$inertia.form({
                title: '',
                artist: '',
                image: null,
                audio: null,
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(route('tracks.store'));
        },
    },
};
</script>
