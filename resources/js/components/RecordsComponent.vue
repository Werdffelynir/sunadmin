<template>
    <div class="table-grid">
        <div class="records-bar">
            <ul class="records-menu">
                <li v-for="type in types" v-bind:class="{active: activeType === type.type}" v-on:click="callChunksByType">{{type.type}}</li>
            </ul>
        </div>
        <div class="">
            <ul class="records-menu-chunks">
                <li v-for="chunk in chunks" class="table-grid">
                    <span><a v-bind:href="'/chunk/editor/' + chunk.id">{{chunk.title}} <span v-if="!!chunk.name" class="chunk_name">({{chunk.name}})</span></a></span>
                    <span class="w-25">
                        <span v-if="chunk.status"> <i></i> </span>
                        <span v-else=""> <i>off</i> </span>
                    </span>
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

    .records-menu, .records-menu-chunks {
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
    .records-menu-chunks li {
        border-bottom: 1px dotted #efefef;
    }

    .records-menu-chunks a {
    }
    .records-menu-chunks a .chunk_name {
        font-size: 90%;
        color: #636b6f;
    }

    .active {
        text-decoration: underline;
    }
</style>

<script>
    export default {
        props: ['datachunks', 'datatypes'],

        data() {
            let activeType = 'main';

            return {
                chunks: [],
                types: JSON.parse(this.datatypes),
                activeType: activeType,
            }
        },

        mounted(){
            const type = localStorage.getItem('selectedTypeList');
            if (type && type !== this.activeType) {
                this.chunksByType(type);
            } else {
                this.chunksByType(this.activeType);
            }
        },

        methods: {
            callChunksByType (e) {
                const type = e.target.textContent.trim();
                localStorage.setItem('selectedTypeList', type);
                this.chunksByType(type);
            },

            chunksByType (type) {
                axios.post('/chunks/type', {type: type})
                .then(res => {
                    this.chunks = res.data.chunks;
                    this.activeType = type;
                })
                .catch(err => {
                    console.error(err)
                });
            },

        },

    }
</script>
