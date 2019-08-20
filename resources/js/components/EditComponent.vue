<template>
    <div>

        <b-row class="mt-3">
            <b-col class="mt-2">
                <b-form-checkbox v-model="chunk.status" name="check-button" switch>
                    STATUS <b>(ACTIVE: {{ chunk.status }})</b>
                </b-form-checkbox>

                <div class="mt-3">
                    <div><code>type_name.item_name|item_id</code></div>
                    <div><code>{{ chunkmixins[0] ? chunkmixins[0].type : 'type_name' }}.{{ chunk.id }}</code></div>
                    <div><code>{{ chunkmixins[0] ? chunkmixins[0].type : 'type_name' }}.{{ chunk.title }}</code></div>
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
                    <span  v-for="mixin in chunkmixins" >
                        <b-list-group-item class="d-flex justify-content-between align-items-center">
                            {{mixin.type}}
                            <b-badge variant="primary" pill @click="chunkmixinRemove(mixin.type)">RM</b-badge>
                        </b-list-group-item>
                    </span>
                </b-list-group>
            </b-col>
        </b-row>

        <b-input-group prepend="TITLE" class="mt-3">
            <b-form-input v-model="chunk.title"></b-form-input>
        </b-input-group>

        <b-input-group prepend="BODY" class="mt-3">
            <b-form-textarea v-model="chunk.body" ></b-form-textarea>
        </b-input-group>

        <b-row class="mt-3">
            <b-col>
                <b-button v-b-modal.remove >Delete</b-button>
            </b-col>
            <b-col class="text-right">
                <b-button v-on:click="save" variant="success">Save</b-button>
            </b-col>
        </b-row>

        <div class="spinner" v-bind:class="{ show: loading }">
            <div class="spinner-grow" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <b-modal id="remove" title="Delete Records" @ok="remove">
            <p class="my-4">Please confirm remove item - "<strong>{{ chunk.title }}</strong>"!</p>
        </b-modal>
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

    const URL_LIST = '/list';
    const URL_SAVE = '/chunk/editor/';

    export default {

        props: ['datachunk', 'datatypes'],

        data() {
            return {
                chunk: JSON.parse(this.datachunk),
                types: JSON.parse(this.datatypes),
                loading: false,
                checked: false,
                selectedType: '',
                chunkmixins:  JSON.parse(this.datachunk).mixins.slice(0),
            }
        },

        computed: {
        },

        mounted() { },

        methods: {
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
