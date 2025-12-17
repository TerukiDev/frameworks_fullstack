<template>
    <div
        class="group cursor-pointer overflow-hidden rounded-xl border bg-card text-card-foreground shadow-sm transition-colors hover:bg-muted/20 active:scale-[0.99]"
        @click="handleClick"
    >
        <div class="relative aspect-[1/1] w-full overflow-hidden">
            <img
                class="h-full w-full object-cover transition-transform duration-200 group-hover:scale-[1.02]"
                :src="`/storage/${track.image}`"
                :alt="track.title"
            />
        </div>

        <div class="space-y-1 p-4">
            <div class="line-clamp-1 text-base font-semibold">
                {{ track.title }}
            </div>
            <div class="line-clamp-1 text-sm text-muted-foreground">
                {{ track.artist }}
            </div>
        </div>

        <div
            v-if="$page.props.isAdmin"
            class="grid grid-cols-2 gap-2 px-4 pb-4"
        >
            <Button as-child variant="outline" @click.stop>
                <Link :href="route('tracks.edit', { track: track })">
                    Modifier
                </Link>
            </Button>

            <Button variant="destructive" @click.stop="destroy">
                Supprimer
            </Button>
        </div>
    </div>
</template>

<script>
import Button from '@/components/ui/button/Button.vue';
import { Link } from '@inertiajs/vue3';

export default {
    name: 'Track',
    emits: ['listen'],
    components: {
        Link,
        Button,
    },
    props: {
        track: Object,
    },
    methods: {
        destroy() {
            this.$inertia.delete(
                route('tracks.destroy', { track: this.track }),
                {
                    preserveScroll: true,
                },
            );
        },
        handleClick() {
            this.$emit('listen', this.track);
        },
    },
};
</script>
