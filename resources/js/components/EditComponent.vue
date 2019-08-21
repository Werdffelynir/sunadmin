<template>
    <div>

        <b-row class="mt-3">
            <b-col class="mt-2">
                <b-form-checkbox v-model="chunk.status" name="check-button" switch>
                    STATUS <b>(ACTIVE: {{ chunk.status }})</b>
                </b-form-checkbox>

                <div class="mt-3">
                    <div><code>type_name.item_name|item_id</code></div>
                </div>
            </b-col>
            <b-col>

                <b-input-group>
                    <b-input-group-text slot="prepend">TYPE</b-input-group-text>
                    <b-form-input v-model="this.selectedType" v-on:input="inputType"></b-form-input>

                    <b-dropdown text="Dropdown" variant="danger" slot="append">
                        <span v-for="type in types">
                            <b-dropdown-item v-on:click="selectType">{{ type.type }}</b-dropdown-item>
                        </span>
                    </b-dropdown>
                    <b-button v-on:click="chunkmixinAdd" variant="outline-primary">+</b-button>
                </b-input-group>

                <b-list-group class="mt-2">
                    <span v-for="mixin in chunkmixins" class="pt-1">
                        <b-list-group-item class="d-flex justify-content-between align-items-center">
                            {{mixin.type}}
                            <b-badge variant="primary" pill @click="chunkmixinRemove(mixin.type)">Remove</b-badge>
                        </b-list-group-item>
                    </span>
                </b-list-group>
            </b-col>
        </b-row>

        <div class="text-right row ">
        <div class="col-4">
            <b-input-group prepend="NAME" class="mt-3">
                <b-form-input v-model="chunk.name"></b-form-input>
            </b-input-group>
        </div>
        </div>

        <b-input-group prepend="TITLE" class="mt-3">
            <b-form-input v-model="chunk.title"></b-form-input>
        </b-input-group>

        <b-input-group prepend="BODY" class="mt-3">
            <b-form-textarea v-model="chunk.body" rows="5" ></b-form-textarea>
        </b-input-group>

        <h4 class="mt-4 text-right">OPTIONS</h4>

        <div class="mt-2">
            <div class="text-right row ">
                <div class="col"></div>
                <div class="col-4">
                    <b-form-input small v-model="optionNameCurrent"></b-form-input>
                </div>
                <div class="col-2">
                    <b-button v-on:click="optionAdd" variant="dark">Add Option</b-button>
                </div>
            </div>

            <i class="fas fa-coffee fa-xs"></i>

            <b-table-simple small stacked table-dark class="mt-2">
                <b-tbody>
                    <b-tr>
                        <b-td>
                            <div v-for="(option, index) in chunkoptions" class="row mt-2">
                                <div class="col-9">
                                    <b-form-input small :value="option.value"
                                                  v-on:change="(v) => optionChange(index, v)"></b-form-input>
                                </div>
                                <div class="col pt-2">{{option.name}}</div>
                                <div class="col text-right">
                                    <b-button variant="light" v-on:click="optionRemove(option.name)">X</b-button>
                                </div>
                            </div>
                        </b-td>
                    </b-tr>
                </b-tbody>
            </b-table-simple>
            <hr>
        </div>

        <div class="mt-3">
            <b-row>
                <b-col>
                    <b-button v-b-modal.remove>Delete</b-button>
                </b-col>
                <b-col class="text-right">
                    <b-row>
                        <b-col>
                            <span class="spinner" v-bind:class="{ show: loading }">
                                <div class="spinner-grow" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </span>
                        </b-col>
                        <b-col> <b-button v-on:click="save" variant="primary">Save</b-button> </b-col>
                    </b-row>
                </b-col>
            </b-row>
            <b-modal id="remove" title="Delete Records" @ok="remove">
                <p class="my-4">Please confirm remove item - "<strong>{{ chunk.title }}</strong>"!</p>
            </b-modal>
        </div>

    </div>

</template>

<style>
    .spinner {
        text-align: center;
        display: none;
    }
    .show {
        display: block;
    }
</style>

<script>

    class TableSimple {

    }

    const URL_LIST = '/list';
    const URL_SAVE = '/chunk/editor/';

    export default {

        props: ['datachunk', 'datatypes'],

        data() {
            const datachunk = JSON.parse(this.datachunk);
            const datatypes = JSON.parse(this.datatypes);
            return {
                chunk: datachunk,
                types: datatypes,
                loading: false,
                checked: false,
                selectedType: '',
                chunkoptions: datachunk.options ? JSON.parse(datachunk.options) : [] ,
                chunkmixins: datachunk.mixins.slice(0),
                optionNameCurrent: 'name',
            }
        },

        computed: {
        },

        mounted() { },

        methods: {

            optionAdd () {
                const name = this.optionNameCurrent.trim();
                if (name.length > 1 && !this.chunkoptions.find((opt) => opt.name === name)) {
                    this.chunkoptions.push({name: name, value: ''});
                    this.optionNameCurrent = '';
                }
            },

            optionRemove (name) {
                this.chunkoptions.forEach((opt, index) => {
                    if (opt.name === name)
                        this.chunkoptions.splice(index, 1)
                });
            },

            optionChange (index, value) {
                this.chunkoptions[index].value = value;
            },

            selectType (e) {
                this.selectedType = e.target.textContent;
            },

            inputType (e) {
                this.selectedType = e;
            },

            chunkmixinAdd (e) {
                if (!!this.selectedType && !this.chunkmixins.filter(m => m.type === this.selectedType).length) {
                    this.chunkmixins.push( {type: this.selectedType} );
                    this.selectedType = '';
                }
            },

            chunkmixinRemove (type) {
                this.chunkmixins.forEach( (m, i) => {
                    if (m.type === type)
                        this.chunkmixins.splice(i, 1);
                });
            },


            save (e) {
                this.loading = true;

                const chunk = Object.assign({}, this.chunk);
                chunk.mixins = this.chunkmixins;
                chunk.options = this.chunkoptions;

                axios.post('/chunk/save', chunk).then(res => {
                    if (res.data.status === 'ok' && res.data.event === 'insert' && res.data.id)
                        location.href = URL_SAVE + res.data.id;
                    this.loading = false;
                }).catch((err) => {
                    this.loading = false;
                })
            },

            remove (e) {
                this.loading = true;

                axios.post('/chunk/remove', this.chunk).then(res => {
                    if (res.data.status === 'ok')
                        location.href = URL_LIST;
                    this.loading = false;
                }).catch((err) => {
                    this.loading = false;
                })
            },

            nameToId (name) {
                let n = name.toLowerCase().replace(/(\s)/, '_')
                return n;
            }
        },
    }
</script>
