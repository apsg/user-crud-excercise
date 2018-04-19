<template>
    <div class="table-container users">

        <users-modify @added="onUserAdded">Add user:</users-modify>
        <hr />

        <table id="users-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Options</th>
                </tr>
            </thead>
        </table>
    </div>
</template>

<script>
    export default {

        data(){
            return {
                table: null
            }
        },

        mounted() {
            this.table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url : '/users/data',
                },
                columns:[
                    { data: 'id', name: 'id', searchable: true },
                    { data: 'name', name: 'name', searchable: true },
                    { data: 'surname', name: 'surname', searchable: true },
                    { data: 'phone', name: 'phone', searchable: true },
                    { data: 'address', name: 'address', searchable: true },
                    { data: 'options', name: 'options', searchable: false }
                ]
            });

        },

        methods: {

            onUserAdded(user){
                this.table.ajax.reload();
            }
        }
    }
</script>
