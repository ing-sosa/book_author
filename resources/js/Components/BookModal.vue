<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';

const props = defineProps({
    book: { type: Object, default: () => ({}) },
    authors: { type: Object, default: () => ({}) },
    modal: String,
    name: String,
    op: String,
    title: String,
});

const form = useForm({
    id: props.book.id,
    title: props.book.title,
    description: props.book.description,
    author_id: props.book.author_id,
    year_published: props.book.year_published,
    isbn: props.book.isbn,
});

const save = () => {
    form.post(route('books.store'), { onSuccess: () => close() });
};

const update = () => {
    form.id = document.querySelector("#id4").value;
    form.title = document.querySelector("#title4").value;
    form.description = document.querySelector("#description4").value;
    form.year_published = document.querySelector("#year_published4").value;
    form.isbn = document.querySelector("#isbn4").value;
    form.author_id = document.querySelector("#author_id4").value;
    form.put(route('books.update', form.id), { onSuccess: () => close() });
};

const close = () => {
    form.reset();
    document.querySelector('#close' + props.op).click();

};
</script>

<template>
    <div class="modal fade" :id="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button type="button" :id="'close' + op" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <BreezeValidationErrors class="mb-4" />
                    <form @submit.prevent="(op === '4' ? update() : save())">
                        <div>
                            <BreezeInput :id="'id' + op" name="id" type="hidden" v-model="form.id" />
                            <BreezeLabel for="title" value="Título" />
                            <BreezeInput :id="'title' + op" name="title" type="text" class="mt-1 block w-full" required
                                v-model="form.title" />
                            <BreezeLabel for="description" value="Descripción" />
                            <BreezeInput v-model="form.description" :id="'description' + op" name="description" type="text"
                                class="mt-1 block w-full" required />
                            <BreezeLabel for="author_id" value="Autor" />
                            <select v-model="form.author_id" class="form-select mt-1 block w-full" aria-label="Autor"
                                :id="'author_id' + op" name="author_id" required>
                                <option v-for="author in authors" :value="author.id">{{ author.name }}</option>
                            </select>
                            <BreezeLabel for="year_published" value="Año de Publicación" />
                            <BreezeInput v-model="form.year_published" :id="'year_published' + op" name="year_published"
                                type="text" class="mt-1 block w-full" required />
                            <BreezeLabel for="isbn" value="ISBN" />
                            <BreezeInput v-model="form.isbn" :id="'isbn' + op" name="isbn" type="text"
                                class="mt-1 block w-full" required />


                        </div>
                        <div class="flex justify-end mt-4">
                            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Confirmar
                            </BreezeButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
