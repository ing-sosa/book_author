<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Swal } from 'sweetalert'
import { Head } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3';
import BookForm from '@/components/BookModal.vue';

const form = useForm({});
const props = defineProps({
    authors: { type: Array, default: () => [] },
    books: { type: Array, default: () => [] },
    book: { type: Object },

});

const deleteBtn = (book) => {
    return swal({
        title: `Desea borrar el Libro: ${book.title}?`,
        icon: 'warning',
        buttons: ['Cancelar', 'OK'],
        dangerMode: true,
    }).then((confirm) => {
        if (confirm) {
            form.delete(route('books.destroy', book.id));
        }
    });
}

const openBookModal = (book) => {
    document.querySelector("#id4").value = book.id;
    document.querySelector("#title4").value = book.title;
    document.querySelector("#description4").value = book.description;
    document.querySelector("#year_published4").value = book.year_published;
    document.querySelector("#isbn4").value = book.isbn;
    document.querySelector("#author_id4").value = book.author_id;
}

</script>

<template>
    <Head title="Libros"></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Libros
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCreateBook">
                            Nuevo Libro <i class="fa-solid fa-circle-plus"></i>
                        </button>
                        <div class="table-responsive mt-4">
                            <table class="table table-striped table-bordered">
                                <thead class="table-primary">
                                    <tr>
                                        <th style="width: 1vw;">Id</th>
                                        <th>Título</th>
                                        <th>Descripción</th>
                                        <th>Autor</th>
                                        <th>Año</th>
                                        <th>ISBN</th>
                                        <th style="width: 1vw;"></th>
                                        <th style="width: 1vw;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="book in books" :key="book.id">
                                        <td>{{ book.id }}</td>
                                        <td>{{ book.title }}</td>
                                        <td>{{ book.description }}</td>
                                        <td>{{ book.author.name }}</td>
                                        <td>{{ book.year_published }}</td>
                                        <td>{{ book.isbn }}</td>
                                        <td>
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalEditBook" @click="openBookModal(book)">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" @click="deleteBtn(book)">
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
        <BookForm :modal="'modalCreateBook'" :title="'Nuevo Libro'" :authors="authors" :op="'3'"></BookForm>
        <BookForm :modal="'modalEditBook'" :title="'Editar Libro'" :authors="authors" :op="'4'"></BookForm>
    </BreezeAuthenticatedLayout>
</template>
