<template>
    <form>

    </form>
</template>

<script>
    export default {

        props: ['message'],

        data() {
            const data = JSON.parse(this.message);
            this.chunk = data.chunk;
            this.types = data.types;
            return {}
        },


        mounted() {
            console.log('mounted', this.types);
            const data = this.chunk;

            const inputElementTitle = document.querySelector('.form-control[name="title"]');
            const inputElementType = document.querySelector('.form-control[name="type"]');
            const inputElementBody = document.querySelector('.form-control[name="body"]');
            const inputElementId = document.querySelector('.form-control[name="id"]');
            const inputElementMixinId = document.querySelector('.form-control[name="mixins_id"]');
            const elemStatusChange = document.querySelector('[data-status-change]');
            const btnSave = document.querySelector('.save');
            const btnType = document.querySelector('.dropdown-menu.select-type');
            const btnStatus = document.querySelector('.dropdown-menu.select-status');

            const select = function () {
                return {
                    title: inputElementTitle.value,
                    type: inputElementType.value,
                    body: inputElementBody.value,
                    id: inputElementId.value,
                    mixins_id: inputElementMixinId.value,
                };
            };

            btnType.addEventListener('click', (eve) => {
                if (eve.target.getAttribute('data-type')) {
                    data.type = eve.target.getAttribute('data-type');
                    inputElementType.value = data.type;
                }
            });

            btnStatus.addEventListener('click', (eve) => {
                if (eve.target.getAttribute('data-status')) {
                    data.status = eve.target.getAttribute('data-status');
                    elemStatusChange.textContent = ' changed to ' + (data.status === '1' ? 'active' : 'deactive')
                }
            });

            btnSave.addEventListener('click', (eve) => {

                const saveData = Object.assign(data, select());

                console.log('saveData >>> ', saveData);


                axios.post('/chunk/save', saveData)
                    .then(res => {

                        if (res.data.status === 'ok' && res.data.event === 'insert' && res.data.id) {
                            console.log(res.id);
                            console.log(inputElementId);
                            inputElementId.value = Number(res.data.id)
                        }
                        console.log(res)
                    }).catch(err => {

                        console.log(err)
                    })
            });

        }
    }
</script>
