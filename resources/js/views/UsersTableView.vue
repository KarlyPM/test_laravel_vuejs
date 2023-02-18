<script lang="ts" setup>
import { ref , onMounted } from 'vue';
import { useRouter } from 'vue-router'
import axios from 'axios';

const items = ref([]);
const router = useRouter();
const IdBeingDeleted = ref(null);
let modalShow = ref(false);

const fields = [
  {
    key:'nombre',
    label:'Nombres'
  },
  {
    key:'apellidos',
    label:'Apellidos'
  },
  {
    key:'cedula',
    label:'Cedula'
  },
  {
    key:'ciudad',
    label:'Ciudad'
  },
  {
    key:'celular',
    label:'Celular'
  },
  {
    key:'actions',
    label:'Acciones'
  }
]

const getUsers = async () => {
  try {
    const response = await axios.get(`/api/users`);
    items.value = response.data;
    console.log(items.value)

  } catch (error) {
    console.error(error);
  }
};

const confirmDeletion = (item: any) => {
    IdBeingDeleted.value = item.id;
    modalShow.value = true;
    console.log(IdBeingDeleted.value)
};

const close = () => {
  modalShow.value = false;
};

const confirm = async () => {
  try{
    let response = await axios.delete(`/api/user/${IdBeingDeleted.value}`)
    modalShow.value = false;
    getUsers();

  }catch(error){
    console.log(error)
  }
}
const goToUpdateUser = (item: any) => {
  router.push({
    name: 'user-update',
    params: {id:item.id}
  })
}

const goToNewUser = () => {
  router.push({
      path: '/user/new'
  })
}

onMounted(() => {
  getUsers();
});

</script>


<template>

  <div class="text-center">
    <div class="w-100 p-3">
      <b-table striped hover :fields="fields" :items="items">
        <template v-slot:cell(actions)="data">
          <b-button variant="primary" size="sm" @click="goToUpdateUser(data.item)">Actualizar</b-button>
          <b-button variant="danger" size="sm" @click="confirmDeletion(data.item)">Eliminar</b-button>
        </template>
      </b-table>
    </div>
    <b-button variant="success" size="sm" @click="goToNewUser">Crear nuevo registro</b-button>
  </div>

    <b-modal v-model="modalShow" title="¿Esta seguro que desea eliminarlo?" hide-footer>
      <b-form @submit.prevent="confirm">
          <b-button size="sm" variant="danger" @click="close" >
              Cancelar
          </b-button>
          <b-button type="submit" size="sm" variant="success">
              Ok
          </b-button>
      </b-form>
  </b-modal>

</template>
  