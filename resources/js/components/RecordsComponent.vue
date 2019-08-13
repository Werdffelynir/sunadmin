<template>
    <div class="table-grid">
        <div class="records-bar">
            <ul class="records-menu">
                <li v-for="type in types" v-bind:class="{active: activeType === type.type}" v-on:click="callChunksByType">{{type.type}}</li>
            </ul>
        </div>
        <div class="">
            <ul class="records-menu">
                <li v-for="chunk in chunks">
                    <a v-bind:href="'/chunk/editor/' + chunk.id">{{chunk.title}}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<style>

    .records-bar {
        width: 20%;
        height: 100%;
        color: #343a40;
    }

    .records-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .records-menu li {
        cursor: pointer;
    }
    .records-menu li:hover {
        text-decoration: underline;
    }

    .active {
        text-decoration: underline;
    }
</style>

<script>
    export default {
        props: ['datachunks', 'datatypes'],

        data() {

            return {
                chunks: JSON.parse(this.datachunks),
                types: JSON.parse(this.datatypes),
                activeType: 'main',
            }
        },

        methods: {
            callChunksByType (e) {
                const type = e.target.textContent.trim();
                this.activeType = type;
                axios
                    .post('/chunks/type', {type: type})
                    .then(res => {
                        this.chunks = res.data.chunks;
                    })
                    .catch(err => {
                        console.error(err)
                    });
            }
        },

        mounted() { },

    }
</script>
