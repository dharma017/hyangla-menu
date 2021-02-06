<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link
        class="text-indigo-400 hover:text-indigo-600"
        :href="route('menus')"
        >Menus</inertia-link
      >
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="submit">
        <div class="p-6 grid gap-4 grid-cols-1">
          <text-input
            v-model="form.title"
            :error="errors.title"
            class="pr-6 pb-8 w-full lg:w-1/2"
            label="Title"
          />

          <!-- <text-editor
            v-model="form.description"
            :error="errors.description"
            class="pr-6 pb-8 w-full lg:w-1/2"
            label="Description"
          /> -->
          <vue-editor
            class="pr-6 pb-8 w-full lg:w"
            label="Description"
            v-model="form.description"
            :editor-toolbar="customToolbar"
          />

          <select-input
            v-model="form.status"
            :error="errors.status"
            class="pr-6 pb-8 w-full lg:w-1/2"
            label="Publish"
          >
            <option :value="true">Active</option>
            <option :value="false">Inactive</option>
          </select-input>

          <file-input
            v-model="form.image"
            :error="errors.image"
            class="pr-6 pb-8 w-full lg:w-1/2"
            type="file"
            accept="image/*"
            label="Menu Image"
          />
          <file-input
            v-model="form.marketing_image"
            :error="errors.marketing_image"
            class="pr-6 pb-8 w-full lg:w-1/2"
            type="file"
            accept="image/*"
            label="Marketing Image"
          />
        </div>
        <select-input
          v-model="form.enable_marketing"
          :error="errors.enable_marketing"
          class="pr-6 pb-8 w-full lg:w-1/2"
          label="Enable Marketing"
        >
          <option :value="true">Yes</option>
          <option :value="false">No</option>
        </select-input>
        <div
          class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center"
        >
          <loading-button :loading="sending" class="btn-indigo" type="submit"
            >Create Menu</loading-button
          >
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from "@/Shared/Layout";
import LoadingButton from "@/Shared/LoadingButton";
import SelectInput from "@/Shared/SelectInput";
import TextInput from "@/Shared/TextInput";
import TextareaInput from "@/Shared/TextareaInput.vue";
import FileInput from "@/Shared/FileInput";
import { VueEditor } from "vue2-editor";

export default {
  metaInfo: { title: "Create Menu" },
  layout: Layout,
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    TextareaInput,
    FileInput,
    VueEditor,
  },
  props: {
    errors: Object,
    organizations: Array,
  },
  remember: "form",
  data() {
    return {
      content: this.value,
      customToolbar: [
        ["bold", "italic", "underline"],
        // [{ list: "ordered" }, { list: "bullet" }],
        // ["image", "code-block"],
      ],
      sending: false,
      form: {
        title: null,
        description: null,
        status: false,
        image: null,
        enable_marketing: false,
        marketing_image: null,
      },
    };
  },
  methods: {
    submit() {
      const data = new FormData();
      data.append("title", this.form.title || "");
      data.append("description", this.form.description || "");
      data.append("status", this.form.status ? "1" : "0");
      data.append("enable_marketing", this.form.enable_marketing ? "1" : "0");
      data.append("image", this.form.image || "");
      data.append("marketing_image", this.form.marketing_image || "");

      this.$inertia.post(this.route("menus.store"), data, {
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },
  },
};
</script>
