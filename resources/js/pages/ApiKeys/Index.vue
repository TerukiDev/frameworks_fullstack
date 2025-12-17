<script setup lang="ts">
import Badge from '@/components/ui/badge/Badge.vue';
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'API Keys',
        href: '/api-keys',
    },
];

defineProps<{
    apiKeys: Array<{
        id: number;
        name: string;
        key: string;
        slug: string;
        created_at: string;
    }>;
}>();
</script>

<template>
    <Head title="API Keys" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">API Keys</h1>
                <Button as-child>
                    <Link :href="route('api-keys.create')">Create API Key</Link>
                </Button>
            </div>

            <div class="space-y-3">
                <Card
                    v-for="apiKey in apiKeys"
                    :key="apiKey.id"
                    class="py-4 transition-colors hover:bg-muted/20 active:scale-[0.99]"
                >
                    <CardContent
                        class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
                    >
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="truncate text-base font-semibold">
                                    {{ apiKey.name }}
                                </p>
                                <Badge variant="secondary">
                                    {{ apiKey.slug }}
                                </Badge>
                            </div>
                            <p
                                class="mt-1 truncate font-mono text-sm text-muted-foreground"
                            >
                                {{ apiKey.key }}
                            </p>
                        </div>

                        <div class="flex items-center gap-2">
                            <Button as-child variant="outline" size="sm">
                                <Link :href="route('api-keys.edit', apiKey.id)">
                                    Edit
                                </Link>
                            </Button>
                            <Button as-child variant="destructive" size="sm">
                                <Link
                                    :href="route('api-keys.destroy', apiKey.id)"
                                    method="delete"
                                    as="button"
                                >
                                    Delete
                                </Link>
                            </Button>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
