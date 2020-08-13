<template>
    <div id="notifications">
        <div v-for="notification in notifications" :class="getNotificationClass(notification)">
            {{ notification.message }}
        </div>
    </div>
</template>

<script>
    export default{
        methods: {
            getNotificationClass: function (notification) {
                return 'alert alert-' + notification.type
            }
        },
        props: ['notifications']
    }
</script>