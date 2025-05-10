<script setup>
import {useCollapsedSidebar} from "@/Custom Js/collaspable.js";
import {Link} from "@inertiajs/vue3";
import logo from "../../images/logo.png"
const isCollapsed = useCollapsedSidebar();
function toggleSidebar() {
    isCollapsed.value = !isCollapsed.value;
}
const data = [
    {
        item: "Add Product",
        link: "/super-admin/add-product",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
</svg>
`
    },
    {
        item: "Users",
        link: "/dashboard/users",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
</svg>


`
    },
    {
        item: "Chats",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
</svg>
`
    },
    {
        item: "Notes",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
</svg>
`
    },
    {
        item: "Log Out",
        link: "/logout",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
</svg>

`
    }
];
</script>

<template>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside  :class="[
        'bg-slate-800 border-r  fixed top-0 left-0 h-full z-50 transition-all duration-300',
        isCollapsed ? 'w-[70px]' : 'w-[250px]'
    ]">

            <div class="shadow bg-cyan-950" :class="isCollapsed ? 'py-7 px-4': 'p-4'">
                <Link href="/super-admin">
                    <img :src="logo" alt="logo" class="transition-all duration-300   mx-auto" :class="isCollapsed? 'h-auto' : 'h-12' " />
                </Link>

            </div>

            <div class="py-6 font-nunito">
                <component
                    v-for="(nav, index) in data"
                    :is="nav.link ? Link : 'div'"
                    :key="index"
                    v-bind="nav.link ? { href: nav.link } : {}"
                    class="group flex items-center gap-3 text-white shadow font-medium px-4 py-2 transition-all duration-300 hover:bg-[#132749] hover:text-white cursor-pointer"
                >
                    <!-- Icon -->
                    <span
                        v-html="nav.icon"
                        class="text-white group-hover:text-white transition-all duration-300 transform group-hover:scale-110"
                    ></span>

                    <!-- Text -->
                    <span
                        v-if="!isCollapsed"
                        class="transition-all duration-300 group-hover:ml-1"
                    >
                      {{ nav.item }}
                    </span>
                </component>
            </div>
        </aside>

        <!-- Content -->
        <div :class="['flex-1 bg-gray-100 min-h-screen transition-all duration-300', isCollapsed ? 'ml-[70px]' : 'ml-[250px]']">
            <!-- Header -->
            <header class="bg-cyan-950 p-6 shadow flex items-center justify-between">
                <div class="space-x-4 flex items-center">
                    <!-- collapse button-->
                    <button class="text-white" @click="toggleSidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <nav class="space-x-4 text-white">
                        <a href="#">Apps</a>
                        <a href="#">Chat</a>
                        <a href="#">Calendar</a>
                        <a href="#">Notes</a>
                    </nav>
                </div>
                <div class="space-x-4 flex items-center">
                    <img src="https://flagcdn.com/w40/gb.png" alt="flag" class="w-5 h-5">
                    <span>🔔</span>
                    <img src="https://i.pravatar.cc/40" class="rounded-full w-8 h-8" alt="user">
                </div>
            </header>

            <!-- Main Content -->
            <main class="p-6">
                <slot/>
            </main>
        </div>
    </div>
</template>


<style scoped>

</style>
