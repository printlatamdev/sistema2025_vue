<script setup>
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Sidebar from '@/Components/Sidebar.vue';
import MobileItems from '@/Components/MobileItems.vue';
defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>

        <Head :title="title" />
        <Banner />
        <div class="min-h-screen bg-gray-100">


            <!-- Page Content -->
            <main>
                <div class="w-full flex">
                    <div class="bg-gray-900 w-1/6 px-1 text-sm h-screen sticky top-0 hidden lg:block md:block transition-transform -translate-x-full sm:translate-x-0">
                        <Sidebar />
                    </div>
                    <div class="bg-white overflow-hidden w-full lg:w-5/6">
                        <nav class="bg-white border-b border-gray-100">
                            <!-- Primary Navigation Menu -->
                            <div class="w-full mx-auto px-4 sm:px-2 lg:px-8">
                                <div class="flex justify-end h-auto p-2">
                                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                                        <div class="ms-3 relative">
                                            <!-- Teams Dropdown -->
                                            <Dropdown v-if="$page.props.jetstream.hasTeamFeatures" align="right"
                                                width="60">
                                                <template #trigger>
                                                    <span class="inline-flex rounded-md">
                                                        <button type="button"
                                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                            {{ $page.props.auth.user.current_team.name }}

                                                            <svg class="ms-2 -me-0.5 h-4 w-4"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                            </svg>
                                                        </button>
                                                    </span>
                                                </template>

                                                <template #content>
                                                    <div class="w-60">
                                                        <!-- Team Management -->
                                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                                            Manage Team
                                                        </div>

                                                        <!-- Team Settings -->
                                                        <DropdownLink
                                                            :href="route('teams.show', $page.props.auth.user.current_team)">
                                                            Team Settings
                                                        </DropdownLink>

                                                        <DropdownLink v-if="$page.props.jetstream.canCreateTeams"
                                                            :href="route('teams.create')">
                                                            Create New Team
                                                        </DropdownLink>

                                                        <!-- Team Switcher -->
                                                        <template v-if="$page.props.auth.user.all_teams.length > 1">
                                                            <div class="border-t border-gray-200" />

                                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                                Switch Teams
                                                            </div>

                                                            <template v-for="team in $page.props.auth.user.all_teams"
                                                                :key="team.id">
                                                                <form @submit.prevent="switchToTeam(team)">
                                                                    <DropdownLink as="button">
                                                                        <div class="flex items-center">
                                                                            <svg v-if="team.id == $page.props.auth.user.current_team_id"
                                                                                class="me-2 h-5 w-5 text-green-400"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 24 24"
                                                                                stroke-width="1.5"
                                                                                stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                            </svg>

                                                                            <div>{{ team.name }}</div>
                                                                        </div>
                                                                    </DropdownLink>
                                                                </form>
                                                            </template>
                                                        </template>
                                                    </div>
                                                </template>
                                            </Dropdown>
                                        </div>
                                        <div v-tooltip="'No se han encontrado notificaciones'" class="cursor-pointer">
                                            <font-awesome-icon :icon="['fas', 'bell']" size="lg" fade class="text-gray-500 hover:text-gray-600" />
                                        </div>
                                        <!-- Settings Dropdown -->
                                        <div class="ms-3 relative ">
                                            <Dropdown align="right" width="48">
                                                <template #trigger>
                                                    <div v-if="$page.props.jetstream.managesProfilePhotos" class="flex cursor-pointer items-center border rounded-2xl mx-1">
                                                        <button
                                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                            <img class="h-8 w-8 rounded-full object-cover"
                                                                :src="$page.props.auth.user.profile_photo_url"
                                                                :alt="$page.props.auth.user.name">
                                                        </button>
                                                        <div>
                                                            <span class="text-sm mx-1">{{ $page.props.auth.user.name }}</span>
                                                        </div>
                                                    </div>

                                                    <span v-else class="inline-flex rounded-md">
                                                        <button type="button"
                                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                            {{ $page.props.auth.user.name }}

                                                            <svg class="ms-2 -me-0.5 h-4 w-4"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                            </svg>
                                                        </button>
                                                    </span>
                                                </template>

                                                <template #content>
                                                    <!-- Account Management -->
                                                    <div class="block px-4 py-2 text-xs text-gray-500">
                                                        Sobre mi cuenta
                                                    </div>

                                                    <DropdownLink :href="route('profile.show')">
                                                        <font-awesome-icon :icon="['fas', 'circle-user']" class="text-gray-600" /> Mi Perfil
                                                    </DropdownLink>

                                                    <DropdownLink v-if="$page.props.jetstream.hasApiFeatures"
                                                        :href="route('api-tokens.index')">
                                                        API Tokens
                                                    </DropdownLink>

                                                    <div class="border-t border-gray-200" />

                                                    <!-- Authentication -->
                                                    <form @submit.prevent="logout">
                                                        <DropdownLink as="button">
                                                            <font-awesome-icon :icon="['fas', 'power-off']" /> Cerrar sesión
                                                        </DropdownLink>
                                                    </form>
                                                </template>
                                            </Dropdown>
                                        </div>
                                    </div>

                                    <!-- Hamburger -->
                                    <div class="flex justify-between  items-center w-full sm:hidden">
                                        <div class="">
                                            <ApplicationLogo />
                                        </div>
                                       <div class="">
                                        <button
                                            class="justify-center rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                                            @click="showingNavigationDropdown = !showingNavigationDropdown">
                                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path
                                                    :class="{ 'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 6h16M4 12h16M4 18h16" />
                                                <path
                                                    :class="{ 'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                       </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Responsive Navigation Menu -->
                            <div :class="{ 'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown }"
                                class="sm:hidden bg-gray-900 ">
                                <!-- Responsive Settings Options -->
                                <div class="border-t p-2 border-gray-200">
                                    <div class="flex items-center p-1">
                                        <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 me-3">
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                :src="$page.props.auth.user.profile_photo_url"
                                                :alt="$page.props.auth.user.name">
                                        </div>

                                        <div>
                                            <div class="font-medium text-base text-white">
                                                {{ $page.props.auth.user.name }}
                                            </div>
                                            <div class="font-medium text-xs text-white">
                                                {{ $page.props.auth.user.email }}
                                            </div>
                                        </div>
                                    </div><hr>
                                    <div class="mt-3 space-y-1">
                                        <MobileItems />
                                        <!-- Authentication -->
                                        <form method="POST" @submit.prevent="logout">
                                            <ResponsiveNavLink as="button">
                                                Cerrar sesión
                                            </ResponsiveNavLink>
                                        </form>

                                        <!-- Team Management -->
                                        <template v-if="$page.props.jetstream.hasTeamFeatures">
                                            <div class="border-t border-gray-200" />

                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                Manage Team
                                            </div>

                                            <!-- Team Settings -->
                                            <ResponsiveNavLink
                                                :href="route('teams.show', $page.props.auth.user.current_team)"
                                                :active="route().current('teams.show')">
                                                Team Settings
                                            </ResponsiveNavLink>

                                            <ResponsiveNavLink v-if="$page.props.jetstream.canCreateTeams"
                                                :href="route('teams.create')" :active="route().current('teams.create')">
                                                Create New Team
                                            </ResponsiveNavLink>

                                            <!-- Team Switcher -->
                                            <template v-if="$page.props.auth.user.all_teams.length > 1">
                                                <div class="border-t border-gray-200" />

                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Switch Teams
                                                </div>

                                                <template v-for="team in $page.props.auth.user.all_teams"
                                                    :key="team.id">
                                                    <form @submit.prevent="switchToTeam(team)">
                                                        <ResponsiveNavLink as="button">
                                                            <div class="flex items-center">
                                                                <svg v-if="team.id == $page.props.auth.user.current_team_id"
                                                                    class="me-2 h-5 w-5 text-green-400"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                <div>{{ team.name }}</div>
                                                            </div>
                                                        </ResponsiveNavLink>
                                                    </form>
                                                </template>
                                            </template>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </nav>
                        <!--main content-->
                        <div class="p-7">
                            <slot />
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>
