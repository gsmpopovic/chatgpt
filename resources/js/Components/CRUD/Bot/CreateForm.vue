<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputElement from '@/Components/InputElement.vue';

defineProps({
    status: String,
});

const formValues = {

    /* Widget settings */
    title: '',
    chat_server:'/botman',
    iframe_endpoint:'/botman/chat',
    time_format:'',
    datetime_format:'',
    title:'',
    intro_message:'',
    display_message_time:'',
    placeholder_text:'',
    main_color:'',
    bubble_avatar_url:'',
    desktop_height:'',
    desktop_width:'',
    mobile_height:'',
    mobile_width:'',
    video_height:'',
    about_link:'',
    
    /* Bot settings */
    model:'',
    temperature:'',
    max_tokens:'',
    frequency_penalty:'',
    presence_penalty:'',
};

const normalizeInputName = function(string){
    
    let name = string.split('_').join(' ');
    
    return name; 

}

const setupFormElements = function(obj){

    let elems = [];

    for (const [key, value] of Object.entries(obj)) {
        
        let elem = {};
        elem.label = normalizeInputName(key); 

        elem.name = key; 
        elem.value = value;
        elem.type = 'text';
        elems.push(elem);
    }

    return elems; 

};

const formElements = setupFormElements(formValues);


const form = useForm(formValues);

const submit = () => {
    form.post(route('bot.store'));
};
</script>

<template>

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Here you can customize the look and feel of the widget, and set some settings for the AI you would like to use. 
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div v-for="elem in formElements">
                <InputLabel :for="elem.name" :value="elem.label" />
                <InputElement
                    :id="elem.name"
                    v-model="form[elem.name]"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors[elem.name]" />
                <br>
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Submit
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
