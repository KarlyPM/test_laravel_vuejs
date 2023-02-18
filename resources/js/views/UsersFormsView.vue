<script lang="ts" setup>
import { reactive , ref, onMounted } from 'vue';
import { useRouter } from 'vue-router'
import axios from 'axios';
import { useRoute } from "vue-router";
import { useToast } from "vue-toast-notification";

const toast = useToast();

const route = useRoute();

let userShowId = route.params.id

const objectUser = reactive({
  nombre: '',
  apellidos: '',
  cedula: '',
  celular:'',
  ciudad: '',
});

const city = ref([
    { text: 'Selecciona una', value: null },
    { text: 'Guayaquil', value: 'Guayaquil' },
    { text: 'Quito', value: 'Quito' },
    { text: 'Cuenca', value: 'Cuenca' },
    { text: 'Ambato', value: 'Ambato' },
]);

const createUser = async () => {
  try{ 
    const response = await axios.post('/api/user', objectUser)
    toast.success('Usuario creado correctamente');
  
  } catch (error) {
    console.log(error);
    toast.error('Ha ocurrido un error');
  }
}

const getUser = async () => {
  try {
    if(userShowId != null){

      const response = await axios.get(`/api/user/${userShowId}`);
      objectUser.nombre = response.data.nombre,
      objectUser.apellidos = response.data.apellidos,
      objectUser.cedula = response.data.cedula,
      objectUser.celular = response.data.celular,
      objectUser.ciudad = response.data.ciudad
    }
  } catch (error) {
    console.log(error);
  }
};

const updateUser = async () => {
try{
    const response = await axios.put(`/api/user/${userShowId}`, objectUser)
    toast.success('Se ha actualizado correctamente');
  } catch (error) {
    console.log(error);
    toast.error('Ha ocurrido un error');
  }
}


const submit = async () => {
  if (route.path === `/user/new`) {
        createUser()
    } else {
        updateUser()
    } 
}

onMounted(() => {
    getUser();
});
</script>
<template>
    
    <div class="w-75 p-3 mb-1">

        <b-form @submit="submit">
            <b-form-group id="input-group-1" label="Nombres:" label-for="input-1">
            <b-form-input
                id="input-1"
                v-model="objectUser.nombre"
                placeholder="Ingrese sus nombres"
                required
            ></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label="Apellidos:" label-for="input-2">
                <b-form-input
                id="input-2"
                v-model="objectUser.apellidos"
                placeholder="Ingrese sus apellidos"
                required
                ></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-3" label="Cedula:" label-for="input-3">
                <b-form-input
                v-model="objectUser.cedula"
                id="input-3"
                required
                ></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-4" label="Numero celular:" label-for="input-4">
                <b-form-input
                id="input-4"
                v-model="objectUser.celular"
                placeholder="Celular"
                required
                ></b-form-input>
            </b-form-group>


            <b-form-group id="input-group-5" label="Ciudad:" label-for="input-5">
                <b-form-select
                id="input-5"
                v-model="objectUser.ciudad"
                :options="city"
                required
                ></b-form-select>
            </b-form-group>

            <b-button type="submit" variant="primary">Submit</b-button>
            <b-button type="reset" variant="danger">Reset</b-button>
        </b-form>
    </div>
</template>