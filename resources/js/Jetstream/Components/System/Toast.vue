<template>
    <transition name="toast">
        <div class="left-10 w-80 fixed inset-x-0 bottom-10 z-50 text-center" v-if="isShown">
            <div class="p-3 text-white rounded-3xl px-5 shadow bg-opacity-95 break-words" :class="classType">
                {{ message }}
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        message: {
            type: String,
            required: true,
        },
        isShown: {
            type: Boolean,
            required: false,
            default: () => {
                return false;
            },
        },
        type: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            templateType: this.type,
        };
    },
    computed: {
        classType() {
            switch (this.type) {
                case "success":
                    return { "bg-green-600": true };
                case "error":
                    return { "bg-red-600": true };
                default:
                    return { "bg-green-600": true };
            }
        },
    },
};
</script>

<style scoped>
.toast-enter-from {
    opacity: 0;
    transform: translateY(100%);
}

.toast-enter-active {
    transition: all 0.5s ease;
    /* animation: wiggle .75s ease; */
}

.toast-leave-to {
    opacity: 0;
    transform: translateY(100%);
}

.toast-leave-active {
    transition: all 0.5s ease;
}

@keyframes wiggle {
    0% {
        transform: translateY(-60px);
        opacity: 0;
    }

    50% {
        transform: translateY(0px);
        opacity: 1;
    }

    60% {
        transform: translateX(8px);
    }

    70% {
        transform: translateX(-8px);
    }

    80% {
        transform: translateX(4px);
    }

    90% {
        transform: translateX(-4px);
    }

    100% {
        transform: translateX(0px);
    }
}
</style>
