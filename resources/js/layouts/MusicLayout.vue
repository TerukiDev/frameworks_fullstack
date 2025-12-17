<template>
    <div>
        <nav class="border-b bg-background">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between gap-4">
                    <div class="flex min-w-0 items-center gap-4">
                        <Link
                            :href="route('tracks.index')"
                            class="flex items-center gap-2"
                        >
                            <img
                                class="h-8 w-8"
                                src="/images/spotify.png"
                                alt="Spotify"
                            />
                            <span class="hidden text-sm font-semibold sm:inline"
                                >Music</span
                            >
                        </Link>

                        <div class="flex items-center gap-2">
                            <Button
                                as-child
                                :variant="
                                    route().current().includes('tracks')
                                        ? 'secondary'
                                        : 'ghost'
                                "
                                size="sm"
                            >
                                <Link :href="route('tracks.index')"
                                    >Musiques</Link
                                >
                            </Button>
                            <Button
                                as-child
                                :variant="
                                    route().current().includes('playlists')
                                        ? 'secondary'
                                        : 'ghost'
                                "
                                size="sm"
                            >
                                <Link :href="route('playlists.index')"
                                    >Playlists</Link
                                >
                            </Button>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <Button
                            v-if="$page.props.auth.user"
                            as-child
                            variant="outline"
                            size="sm"
                        >
                            <Link
                                :href="route('logout')"
                                method="post"
                                as="button"
                                preserve-scroll
                            >
                                Log out
                            </Link>
                        </Button>

                        <template v-else>
                            <Button as-child variant="ghost" size="sm">
                                <Link :href="route('login')">Log in</Link>
                            </Button>
                            <Button as-child size="sm">
                                <Link :href="route('register')">Register</Link>
                            </Button>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div
                class="my-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
            >
                <h4 class="text-3xl font-bold">
                    <slot name="title" />
                </h4>
                <div class="flex items-center gap-2">
                    <slot name="actions" />
                </div>
            </div>

            <slot name="content" />
        </div>
    </div>
</template>

<script>
import Button from '@/components/ui/button/Button.vue';
import { Link } from '@inertiajs/vue3';

export default {
    name: 'MusicLayout',
    components: {
        Link,
        Button,
    },
};
</script>
