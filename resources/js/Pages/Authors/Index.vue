<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Swal } from 'sweetalert'
import { Head } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3';
import AuthorForm from '@/components/AuthorModal.vue';

const form = useForm({});
const props = defineProps({
    authors: {
        type: Array,
        default: () => []
    },
    author: { type: Object },
    editFlag: Boolean,
});

const deleteBtn = (author) => {
    return swal({
        title: `Desea borrar el Autor: ${author.name}?`,
        text: 'Los libros de este autor se borraran.',
        icon: 'warning',
        buttons: ['Cancelar', 'OK'],
        dangerMode: true,
    }).then((confirm) => {
        if (confirm) {
            form.delete(route('authors.destroy', author.id));
        }
    });
}

const openModal = (author) => {
    document.getElementById('id2').value = author.id
    document.getElementById('name2').value = author.name
}

</script>

<template>
    <Head title="Autores"></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Autores
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCreate">
                            Nuevo Autor <i class="fa-solid fa-circle-plus"></i>
                        </button>
                        <div class="table-responsive mt-4">
                            <table class="table table-striped table-bordered">
                                <thead class="table-primary">
                                    <tr>
                                        <th style="width: 1vw;">Id</th>
                                        <th>Name</th>
                                        <th style="width: 1vw;"></th>
                                        <th style="width: 1vw;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="author in authors" :key="author.id">
                                        <td>{{ author.id }}</td>
                                        <td>{{ author.name }}</td>
                                        <td>
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit" @click="openModal(author)">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" @click="deleteBtn(author)">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <AuthorForm :modal="'modalCreate'" :title="'Nuevo Autor'" :op="'1'"></AuthorForm>
        <AuthorForm :modal="'modalEdit'" :title="'Editar Autor'" :op="'2'"></AuthorForm>

    </BreezeAuthenticatedLayout>
</template>
