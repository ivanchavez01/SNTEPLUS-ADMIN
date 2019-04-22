<template>
    <div class="card">
        <div class="card-header">Enviar mensaje</div>
        <div class="card-body">

            <div class="form-group">
                <label>Enviar a</label>
                <select v-model="type" class="form-control">
                    <option value="device">Device</option>
                    <option value="channel">Channel</option>
                </select>
            </div>
            <div class="form-group" v-if="type == 'device'">
                <label>Register ID</label>
                <input type="text" v-model="message.to" class="form-control">
            </div>
            <div class="form-group" v-if="type == 'channel'">
                <label>Channel</label>
                <input type="text" v-model="message.to" class="form-control">
            </div>
            <div class="form-group">
                <label>Titulo</label>
                <input type="text" v-model="message.title" class="form-control">
            </div>
            <div class="form-group">
                <label>Mensaje</label>
                <input type="text" v-model="message.message" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" @click="send()">
                    Enviar
                </button>
            </div>

        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            type: 'device',
            message: {
                to: "",
                title: "",
                title: "",
                message: ""
            }
        }
    },
    methods: {
        send() {
            let message = JSON.parse(JSON.stringify(this.message))

            if(this.type == 'channel')
                message.to = "/topics/" + message.to

            axios.post("/api/fcm/sender", message)
            .then(() => {
               alert("El mensaje se envio correctamente!")
            })
            .catch(() => {
               alert("Hubo un error al enviar el mensaje.")
            })
        }
    }
}
</script>
