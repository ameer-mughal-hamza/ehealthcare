<template>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Prescription Form</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="mb-3" v-for="(row, index) in rows" v-bind:key="row.id">
                            <div class="row">
                                <div class="col-md-4">
                                    <v-select
                                        :value="'Canada'"
                                        :name="'name' + index"
                                        v-model="rows[index].name"
                                        :options="['Canada', 'United States']"
                                    ></v-select>
                                    <!--                                <input type="text"-->
                                    <!--                                       :name="'name' + index"-->
                                    <!--                                       v-model="rows[index].name"-->
                                    <!--                                       class="form-control form-control-lg m-b">-->
                                </div>
                                <div class="col-md-4">
                                    <input type="text"
                                           :name="'quantity' + index"
                                           v-model="rows[index].quantity"
                                           class="form-control form-control-lg m-b"
                                           placeholder="Search in table">
                                </div>
                                <!--                            <div class="col-md-4">-->
                                <!--                                <input type="text"-->
                                <!--                                       :name="'description' + index"-->
                                <!--                                       v-model="rows[index].description"-->
                                <!--                                       class="form-control form-control-lg m-b"-->
                                <!--                                       placeholder="Search in table">-->
                                <!--                            </div>-->
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

                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary" type="button" @click="addNewRow()">
                                    <!--                                    <i class="fa fa-plus fa-lg"></i>-->
                                    Add New Row
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-success" type="button" @click="submit()">
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
                {id: 1, name: "", quantity: "", description: "", display: false}
            ]
        }
    },
    methods: {
        addNewRow() {
            console.log("add rows")
            let id = new Date().getTime();
            this.rows.push({id, name: "", quantity: "", description: "", display: false})
        },
        removeRow(index) {
            const findIndex = this.rows.findIndex(a => a.id === index)
            findIndex !== -1 && this.rows.splice(findIndex, 1)
        },
        showOrHideDescription(index, val) {
            const findIndex = this.rows.findIndex(a => a.id === index)
            // console.log(val);
            this.$set(this.rows[findIndex], 'display', val);
            // console.log(this.rows[findIndex]);
        },
        submit() {
            const payload = {
                prescriptions: this.rows,
                user_id: JSON.parse(this.user).id,
                doctor_id: JSON.parse(this.doctor).id
            }
            console.log(payload);
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
                const prescription = JSON.parse(response.data.slice(2));
                // console.log(prescription);
                // console.log(JSON.parse(prescription));
                this.rows = prescription;
            });
        }
    },
    mounted() {
        console.log(this.doctor);
        // this.fetchPrescription();
        let vm = this
        let select = $(this.$el)
        select.select2({
            placeholder: 'Select',
            theme: 'bootstrap',
            width: '100%',
            allowClear: true,
            data: this.select2data
        }).on('change', function () {
            vm.$emit('input', select.val())
        })
        select.val(this.value).trigger('change')
    }
}
</script>

<style>
.vs__search {
    height: 30px !important;
}
</style>
