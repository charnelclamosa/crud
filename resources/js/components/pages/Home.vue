<template>
<v-app class="homeApp">
    <v-row justify="center" align="center">
        <v-card elevation="12" width="1000" height="770">
            <v-card-title>
                <card-header title="Basic CRUD app"></card-header>
            </v-card-title>
            <v-card-subtitle class="mt-12">
                <div class="text-end mr-5">
                    <v-btn color="primary" @click="CreateDialog = true">Add</v-btn>
                </div>
            </v-card-subtitle>
            <v-card-text>
                <v-simple-table class="mx-5">
                    <template v-slot:default>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="data in datas" :key="data.id">
                                <td>{{data.id}}</td>
                                <td>{{data.name}}</td>
                                <td>{{data.gender}}</td>
                                <td>{{data.age}}</td>
                                <td>{{data.address}}</td>
                                <td>
                                    <v-icon color="success" class="mr-5" @click="passObject(data)">mdi-pencil</v-icon>
                                    <v-icon color="error" @click="confirmation(data)">mdi-delete</v-icon>
                                </td>
                            </tr>
                        </tbody>
                    </template>
                </v-simple-table>
            </v-card-text>
        </v-card>
        <!-- Create -->
        <v-dialog v-model="CreateDialog" width="500" persistent>
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>
                    <span class="font-weight-bold">Create</span>
                </v-card-title>
                <v-card-text class="mt-5">
                    <v-form class="mx-5">
                        <v-row>
                            <v-text-field dense outlined v-model="create.name" label="Name"></v-text-field>
                        </v-row>
                        <v-row class="my-n5 ml-n6">
                            <v-col cols="5">
                                <v-select dense outlined label="Gender" :items="Gender" v-model="create.gender" class="mr-1"></v-select>
                            </v-col>
                            <v-col cols="5">
                                <v-text-field dense outlined label="Age" type="number" v-model="create.age" class="ml-1"></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row class="mb-n5">
                            <v-textarea dense outlined label="Address" rows="2" no-resize v-model="create.address"></v-textarea>
                        </v-row>
                    </v-form>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="error" outlined @click="CreateDialog = false">
                        Cancel
                    </v-btn>
                    <v-btn color="primary" @click="createData()">
                        Create
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Edit -->
        <v-dialog v-model="EditDialog" width="500" persistent>
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>
                    <span class="font-weight-bold">Edit</span>
                </v-card-title>
                <v-card-text class="mt-5">
                    <v-form class="mx-5">
                        <v-row>
                            <v-text-field dense outlined v-model="edit.name" label="Name"></v-text-field>
                        </v-row>
                        <v-row class="my-n5 ml-n6">
                            <v-col cols="5">
                                <v-select dense outlined label="Gender" :items="Gender" v-model="edit.gender" class="mr-1"></v-select>
                            </v-col>
                            <v-col cols="5">
                                <v-text-field dense outlined label="Age" type="number" v-model="edit.age" class="ml-1"></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row class="mb-n5">
                            <v-textarea dense outlined label="Address" rows="2" no-resize v-model="edit.address"></v-textarea>
                        </v-row>
                    </v-form>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="error" outlined @click="EditDialog = false">
                        Cancel
                    </v-btn>
                    <v-btn color="primary" @click="updateData()">
                        Update
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</v-app>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        var self = this
        return {
            notificationSystem: {
                options: {
                    success: {
                        position: 'bottomRight'
                    },
                    error: {
                        position: 'bottomRight'
                    },
                    question: {
                        close: false,
                        overlay: true,
                        toastOnce: true,
                        id: 'question',
                        zindex: 999,
                        position: 'center',
                        buttons: [
                            ['<button><b>YES</b></button>', function (instance, toast) {
                                instance.hide({
                                    transitionOut: 'fadeOut'
                                }, toast, 'button');
                                self.deleteData()
                            }, true],
                            ['<button>NO</button>', function (instance, toast) {
                                instance.hide({
                                    transitionOut: 'fadeOut'
                                }, toast, 'button');
                            }]
                        ]
                    }
                }
            },
            CardTitle: 'Basic CRUD',
            CreateDialog: false,
            EditDialog: false,
            datas: [],
            create: {},
            edit: {},
            delete: {},
            Gender: [
                'Male',
                'Female'
            ],
        }
    },
    created() {
        this.readData()
    },
    methods: {
        createData() {
            let name = this.create.name
            let gender = this.create.gender
            let age = this.create.age
            let address = this.create.address
            if (name == '' || name == null) {
                this.$toast.error('Name is required!', 'Error', this.notificationSystem.options.error)
            } else if (gender == '' || gender == null) {
                this.$toast.error('Gender is required!', 'Error', this.notificationSystem.options.error)
            } else if (age == '' || age == null) {
                this.$toast.error('Age is required!', 'Error', this.notificationSystem.options.error)
            } else if (address == '' || address == null) {
                this.$toast.error('Address is required!', 'Error', this.notificationSystem.options.error)
            } else {
                axios.post('api/create', {
                    name: this.create.name,
                    gender: this.create.gender,
                    age: this.create.age,
                    address: this.create.address
                }).then(res => {
                    this.CreateDialog = false
                    this.$toast.success('New data has been added!', 'Success', this.notificationSystem.options.success)
                    this.readData()
                    this.refreshCreate()
                })
            }
        },
        refreshCreate() {
            this.create = []
        },
        readData() {
            axios.post('api/read').then(res => {
                this.datas = res.data
            })
        },
        passObject(val) {
            this.EditDialog = true
            this.edit = Object.assign({}, val)
        },
        updateData() {
            let name = this.edit.name
            let gender = this.edit.gender
            let age = this.edit.age
            let address = this.edit.address
            if (name == '' || name == null) {
                this.$toast.error('Name is required!', 'Error', this.notificationSystem.options.error)
            } else if (gender == '' || gender == null) {
                this.$toast.error('Gender is required!', 'Error', this.notificationSystem.options.error)
            } else if (age == '' || age == null) {
                this.$toast.error('Age is required!', 'Error', this.notificationSystem.options.error)
            } else if (address == '' || address == null) {
                this.$toast.error('Address is required!', 'Error', this.notificationSystem.options.error)
            } else {
                axios.post('api/update', {
                    id: this.edit.id,
                    name: this.edit.name,
                    gender: this.edit.gender,
                    age: this.edit.age,
                    address: this.edit.address
                }).then(res => {
                    this.EditDialog = false
                    this.$toast.success('Data has been updated!', 'Success', this.notificationSystem.options.success)
                    this.readData()
                })
            }
        },
        confirmation(val) {
            this.delete = Object.assign({}, val)
            this.$toast.question('Are you sure you want to delete this data?', 'Confirmation',
                this.notificationSystem.options.question)
        },
        deleteData() {
            axios.post('api/delete', {
                id: this.delete.id
            }).then(res => {
                this.$toast.success('Data has been deleted!', 'Success', this.notificationSystem.options.success)
                    this.readData()
            })
        }
    }
}
</script>

<style scoped>
.homeApp {
    background-color: whitesmoke;
}

.cardHeader {
    background: linear-gradient(45deg, #5189c1 25%, #41b883);
    color: white;
    font-weight: bold;
}
</style>
