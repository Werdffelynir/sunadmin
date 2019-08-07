let mutations = {
    CREATE_CHUNK(state, chunk) {
        state.chunks.unshift(chunk)
    },
    FETCH_CHUNKS(state, chunks) {
        return state.chunks = chunks
    },
    DELETE_CHUNK(state, chunk) {
        let index = state.chunks.findIndex(item => item.id === chunk.id)
        state.chunks.splice(index, 1)
    }

}
export default mutations
