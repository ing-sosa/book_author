<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';

const props = defineProps({
    author: { type: Object, default: () => ({}) },
    modal: String,
    name: String,
    op: String,
    title: String,
});

const form = useForm({
    id: props.author.id ?? '',
    name: props.author.name ?? '',
});


const save = () => {
    form.post(route('authors.store'), { onSuccess: () => close() });
};

const update = () => {
    const id = document.getElementById('id2').value;
    form.put(route('authors.update', id), { onSuccess: () => close() });
};

const close = () => {
    console.info('--props.on', props.on);
    form.reset();
    document.getElementById('close' + props.op).click();

};

console.info('-props', props)
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
                    <form @submit.prevent="(op === '2' ? update() : save())">
                        <div>
                            <BreezeInput :id="'id' + op" name="id" type="hidden" v-model="form.id" />
                            <BreezeLabel for="name" value="Nombre" />
                            <BreezeInput :id="'name' + op" name="name" type="text" class="mt-1 block w-full"
                                v-model="form.name" required autofocus />
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
