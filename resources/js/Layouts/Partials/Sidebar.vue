<template>

    <aside class="col-span-5 md:col-span-4 lg:col-span-3 xl:col-span-3 bg-white border-r">
        <!-- Header -->
        <div class="bg-gray-100 flex p-5 items-center justify-between header">
            <div>
                <img src="dummy/profile-picture.jpeg" class="h-12 w-12 object-cover rounded-full">
            </div>
            <div class="flex gap-2">
                <!-- Status -->

                <!-- End Status -->
                <!-- New Chat -->

                <JetDropdown align="right" width="48">
                    <template #trigger>
                        <div
                            class="w-10 h-10 rounded-full grid place-items-center border-0 hover:border-2 transition-all ease-in-out duration-300">
                            <i class="fa-solid text-gray-500 fa-message"></i>
                        </div>
                    </template>

                    <template #content>
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Chat
                        </div>

                        <JetDropdownLink :href="route('dashboard')">
                            New Chat
                        </JetDropdownLink>
                    </template>
                </JetDropdown>
                <!-- End New Chat -->
                <!-- Menu -->
                <JetDropdown align="right" width="48">
                    <template #trigger>
                        <div
                            class="w-10 h-10 rounded-full grid place-items-center border-0 hover:border-2 transition-all ease-in-out duration-300">
                            <i class="fa-solid text-gray-500 fa-ellipsis-vertical"></i>
                        </div>
                    </template>

                    <template #content>
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            System
                        </div>

                        <form @submit.prevent="logout">
                            <JetDropdownLink as="button">
                                Log Out
                            </JetDropdownLink>
                        </form>
                    </template>
                </JetDropdown>
                <!-- End Menu -->
            </div>
        </div>
        <!-- End Header -->
        <!-- Search -->
        <div class="search p-2 border-b border-gray-200 flex items-center">
            <input type="text"
                class="w-full border-gray-100 rounded-lg bg-gray-100 focus:outline-none focus:ring-0 focus:border-transparent"
                placeholder="Cari atau mulai chat baru">
        </div>
        <!-- Search -->
        <!-- Body -->
        <div class="body overflow-auto overflow-x-hidden">
            <div
                class="transition-all ease-in-out duration-200 py-4 px-2 flex gap-4 hover:bg-gray-100 relative border-b border-gray-100 hover:cursor-pointer">
                <div class="w-14 grid items-center justify-center">
                    <img src="dummy/profile-picture.jpeg" class="h-14 w-14 object-cover rounded-full">
                </div>
                <div class="flex items-center w-full">
                    <div class="pr-3 overflow-hidden">
                        <div class="text-lg">
                            Babyboss
                        </div>
                        <div class="flex">
                            <div class="">
                                <!-- Icon -->
                            </div>
                            <div class="whitespace-nowrap text-ellipsis overflow-hidden text-gray-500">
                                wkwkwkwk emote apatuh sayang
                            </div>
                        </div>
                    </div>
                </div>
                <div class="absolute top-4 right-4">
                    <div class="text-gray-500">
                        13.10
                    </div>
                    <div class="">
                        <!-- ICON if pinned -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Body -->
    </aside>
</template>

<script>
export default {

}
</script>

<style>
</style>
