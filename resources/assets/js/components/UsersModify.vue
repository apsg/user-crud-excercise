<template>
    <div class="card card-default">
        <div class="card-body">
            <p><slot></slot></p>
            <form method="post" class="form-inline"
                @submit.prevent="onSubmit"
                @keydown="onKeyDown"

                >
                
                <input id="name" type="text" name="name" class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Name" 
                    v-model="name" 
                    :class="getClass('name')">

                <input type="text" name="surname"  v-model="surname" class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Surname"
                    :class="getClass('surname')">

                <input type="text" name="phone"  v-model="phone" class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Phone"
                    :class="getClass('phone')">

                <input type="text" name="address"  v-model="address" class="form-control mb-2 mr-sm-2 mb-sm-0 col-md-4" placeholder="Address"
                    :class="getClass('address')">
                
                <button class="btn btn-primary">
                    <i class="fa fa-save"></i> Save
                </button>
                
                <span v-if="is_saved">
                    <i class="fa fa-check fa-2x text-success ml-1" 
                        title="All data was successfully saved!"></i>
                </span>

            </form>
            <div class="alert alert-danger mt-2" v-if="hasErrors()">
                <ul>
                    <li v-for="error in errors">{{ error.join(' ') }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>


    export default {

        props: ['user'],

        data(){
            return {
                name: '',
                surname: '',
                phone: '',
                address: '',
                id: 0,
                is_edited: false,
                is_saved: false,
                errors: {}
            }
        },

        mounted(){

            if(this.user){
                this.name = this.user.name;
                this.surname = this.user.surname;
                this.phone = this.user.phone;
                this.address = this.user.address;
                this.id = this.user.id;
                this.is_edited = true;
            }
        },

        computed: {
            
            formData(){
                let data = {
                    name: this.name, 
                    surname: this.surname,
                    phone: this.phone,
                    address: this.address
                };

                if(this.is_edited){
                    data._method = 'PATCH';
                }
                
                return data;
            },

            endpoint(){
                return this.is_edited ? '/users/'+this.id : '/users';
            }

        },

        methods: {

            clearData(){
                this.name = '';
                this.surname = '';
                this.phone = '';
                this.address = '';
            },

            onSubmit(){

                axios.post(this.endpoint, this.formData)
                    .then(res => {
                        
                        this.is_saved = true;

                        if(!this.is_edited){
                            this.clearData();
                            document.getElementById('name').focus();
                        }

                        this.$emit('added', res.data);
                    })
                    .catch(err => {
                        if(err.response.status == 422){
                            console.log(err.response.data);
                            this.errors = err.response.data.errors;
                        }else{
                            alert(err.response.data);
                        }
                    });
            },

            onKeyDown(e){
                this.clearError(e.target.name); 
                this.is_saved=false;
            },

            hasError(field){
                return this.errors.hasOwnProperty(field);
            },

            clearError(field){
                if(field)
                    delete this.errors[field];
                else
                    this.errors = {};
            },

            getError(field){
                if(this.errors[field])
                {
                    return this.errors[field][0];
                }
            },

            countErrors(){
                return Object.keys(this.errors).length;
            },

            hasErrors(){
                return this.countErrors() > 0;
            },

            getClass(field){
                return (this.is_saved ? 'input-saved ' : '')
                    +(this.hasError(field) ? 'input-error' : '');
            }

        }
    }
</script>
