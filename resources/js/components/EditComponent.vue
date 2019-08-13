<template>
    <div>

        <b-row class="mt-3">
            <b-col class="mt-2">
                <b-form-checkbox v-model="chunk.status" name="check-button" switch>
                    STATUS <b>(ACTIVE: {{ chunk.status }})</b>
                </b-form-checkbox>
            </b-col>
            <b-col>
                <b-input-group>
                    <b-input-group-text slot="prepend">TYPE</b-input-group-text>
                    <b-form-input v-model="chunk.type" v-on:input="inputType"></b-form-input>

                    <b-dropdown text="Dropdown" variant="success" slot="append">
                        <span v-for="type in types">
                            <b-dropdown-item v-on:click="selectType">{{ type.type }}</b-dropdown-item>
                        </span>
                    </b-dropdown>
                </b-input-group>
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
                <b-button v-on:click="remove" >Delete</b-button>
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

    const URL_SAVE = '/chunk/editor/';

    export default {

        props: ['datachunk', 'datatypes'],

        data() {
            return {
                chunk: JSON.parse(this.datachunk),
                types: JSON.parse(this.datatypes),
                loading: false,
                checked: false,
            }
        },

        mounted() { },

        methods: {
            selectType (e) {
                this.chunk.type = e.target.textContent;
            },

            inputType (e) {
               this.chunk.type = e;
            },

            save (e) {
                this.loading = true;
                axios.post('/chunk/save', this.chunk)
                    .then(res => {
                        if (res.data.status === 'ok' && res.data.event === 'insert' && res.data.id)
                            location.href = URL_SAVE + res.data.id;
                        this.loading = false;
                    }).catch((err) => {
                        this.loading = false;
                    })
            },

            remove (e) {
                console.log('remove', e);
            },
        },
    }
</script>
