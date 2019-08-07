let actions = {
    createChunk({commit}, chunk) {
        axios.post('/api/chunks', chunk)
            .then(res => {
                commit('CREATE_CHUNK', res.data)
            }).catch(err => {
            console.log(err)
        })
    },
    fetchChunks({commit}) {
        axios.get('/api/chunks')
            .then(res => {
                commit('FETCH_CHUNKS', res.data)
            }).catch(err => {
            console.log(err)
        })
    },
    deleteChunk({commit}, chunk) {
        axios.delete(`/api/chunks/${chunk.id}`)
            .then(res => {
                if (res.data === 'ok')
                    commit('DELETE_CHUNK', chunk)
            }).catch(err => {
            console.log(err)
        })
    }
}

export default actions
