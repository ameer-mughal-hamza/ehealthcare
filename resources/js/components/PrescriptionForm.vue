<template>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Prescription Form</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group" v-for="(row, index) in rows" v-bind:key="row.id">
                            <div class="row">
                                <div class="col-md-4">
                                    <v-select @input="checkForError" :name="'name' + index"
                                              v-model="rows[index].name"
                                              :options="medicines"></v-select>
                                    <span class="text-danger" v-model="rows[index].name_error">{{
                                            rows[index].name_error
                                        }}</span>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control form-control-lg m-b" style="height: 40px !important;"
                                            name="quantity" v-model="rows[index].quantity">
                                        <option value="">-- Select Quantity --</option>
                                        <option value="1 + 1 + 1">1 + 1 + 1</option>
                                        <option value="0 + 1 + 1">0 + 1 + 1</option>
                                        <option value="1 + 0 + 1">1 + 0 + 1</option>
                                        <option value="0 + 0 + 1">0 + 0 + 1</option>
                                        <option value="1 + 1 + 0">1 + 1 + 0</option>
                                        <option value="0 + 1 + 0">0 + 1 + 0</option>
                                        <option value="1 + 0 + 0">1 + 0 + 0</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <span @click="showOrHideDescription(row.id, !rows[index].display)"
                                          style="cursor: pointer;">{{ rows[index].display ? 'Hide' : 'Show' }}</span>
                                </div>
                                <div class="col-md-2 text-right">
                                    <button class="btn btn-danger btn-right" type="button" @click="removeRow(row.id)">
                                        Remove
                                    </button>
                                </div>
                            </div>
                            <div class="row" v-show="rows[index].display">
                                <div class="col-md-12">
                                    <textarea :name="'description' + index" class="form-control"
                                              v-model="rows[index].description" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <button title="Add new Row" class="btn btn-warning" type="button" @click="addNewRow()">
                                Add
                            </button>
                        </div>
                        <div class="form-group">
                            <textarea name="remarks" v-model="remarks" placeholder="Add remarks here" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary" type="button" @click="submit()">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['user', 'doctor'],
    data() {
        return {
            rows: [
                {id: 1, name: "", quantity: "", description: "", display: false, name_error: ""}
            ],
            remarks: "",
            medicines: []
        }
    },
    methods: {
        checkForError() {
            this.rows.map(item => {
                if (item.name) {
                    item.name_error = null;
                }
            });

            console.log(this.rows)
        },
        addNewRow() {
            console.log("add rows")
            let id = new Date().getTime();
            this.rows.push({
                id, name: "",
                quantity: "",
                description: "",
                display: false
            })
        },
        removeRow(index) {
            const findIndex = this.rows.findIndex(a => a.id === index)
            findIndex !== -1 && this.rows.splice(findIndex, 1)
        },
        showOrHideDescription(index, val) {
            const findIndex = this.rows.findIndex(a => a.id === index)
            this.$set(this.rows[findIndex], 'display', val);
        },
        submit() {
            let error = false;
            this.rows.map(item => {
                if (item.name === "" || item.name === null) {
                    item.name_error = "The field is required";
                    error = true;
                }
            });

            if (error) return;

            const payload = {
                prescriptions: this.rows,
                user_id: JSON.parse(this.user).id,
                doctor_id: JSON.parse(this.doctor).id,
                remarks: this.remarks,
            }

            axios.post('/api/prescription', payload)
                .then(response => {
                    window.location.href = '/doctor/dashboard';
                })
                .catch(error => {
                    console.log(error);
                });
        },
        fetchPrescription() {
            axios.get('/api/prescription/1').then(response => {
                this.rows = response.data;
            });
        },
        fetchMedicines() {
            axios.get('/api/medicines').then(response => {
                this.medicines = response.data.medicines
            });
        }
    },
    mounted() {
        console.log(this.user);
        console.log(this.doctor);
        this.fetchMedicines();
    }
}
</script>

<style>
.vs__search {
    height: 30px !important;
}
</style>
