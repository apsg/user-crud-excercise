<template>
    <div class="">
        <users-modify @added="onUserCreated">Create user:</users-modify>
    </div>
</template>

<script>


    export default {

        methods: {

            onUserCreated(){

                window.location.href = '/users';
                
            }

        }
    }
</script>
