<template>
  <div>
    <div class="mb-8 flex justify-start max-w-3xl">
      <h1 class="font-bold text-3xl">
        <inertia-link
          class="text-indigo-400 hover:text-indigo-600"
          :href="route('menus')"
          >Menus</inertia-link
        >
        <span class="text-indigo-400 font-medium">/</span>
        {{ form.title }}
      </h1>
    </div>
    <trashed-message v-if="menu.deleted_at" class="mb-6" @restore="restore">
      This menu has been deleted.
    </trashed-message>
    <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="submit">
        <div class="p-6 grid gap-4 grid-cols-1 max-w-2xl">
          <text-input
            v-model="form.title"
            :error="errors.title"
            class="pr-6 pb-8 w-full lg:w"
            label="Title"
          />
          <!-- <text-editor
            v-model="form.description"
            :error="errors.description"
            class="pr-6 pb-8 w-full lg:w"
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
            class="pr-6 pb-8 w-full lg:w"
            label="Status"
          >
            <option :value="true">Active</option>
            <option :value="false">Inactive</option>
          </select-input>
          <file-input
            v-model="form.image"
            :error="errors.image"
            class="pr-6 pb-8 w-full lg:w"
            type="file"
            accept="image/*"
            label="Image"
          />
          <img v-if="menu.image" class="block" :src="menu.image" />
        </div>
        <div
          class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center"
        >
          <button
            v-if="!menu.deleted_at"
            class="text-red-600 hover:underline"
            tabindex="-1"
            type="button"
            @click="destroy"
          >
            Delete Menu
          </button>
          <loading-button
            :loading="sending"
            class="btn-indigo ml-auto"
            type="submit"
            >Update Menu</loading-button
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
import FileInput from "@/Shared/FileInput";
import TrashedMessage from "@/Shared/TrashedMessage";
import TextareaInput from "@/Shared/TextareaInput.vue";
import { VueEditor } from "vue2-editor";

export default {
  metaInfo() {
    return {
      title: `${this.form.title}`,
    };
  },
  layout: Layout,
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    FileInput,
    TrashedMessage,
    TextareaInput,
    VueEditor,
  },
  props: {
    errors: Object,
    menu: Object,
  },
  remember: "form",
  data() {
    return {
      customToolbar: [
        ["bold", "italic", "underline"],
        // [{ list: "ordered" }, { list: "bullet" }],
        // ["image", "code-block"],
      ],
      sending: false,
      form: {
        title: this.menu.title,
        description: this.menu.description,
        status: this.menu.status,
        image: null,
      },
    };
  },
  methods: {
    submit() {
      var data = new FormData();
      data.append("title", this.form.title || "");
      data.append("description", this.form.description || "");
      data.append("status", this.form.status ? "1" : "0");
      data.append("image", this.form.image || "");
      data.append("_method", "put");

      console.log(
        "🚀 ~ file: Edit.vue ~ line 133 ~ submit ~ data",
        this.form.description
      );
      // return;

      this.$inertia.post(this.route("menus.update", this.menu.id), data, {
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
        onSuccess: () => {
          if (Object.keys(this.$page.errors).length === 0) {
            this.form.image = null;
          }
        },
      });
    },
    destroy() {
      if (confirm("Are you sure you want to delete this menu?")) {
        this.$inertia.delete(this.route("menus.destroy", this.menu.id));
      }
    },
    restore() {
      if (confirm("Are you sure you want to restore this menu?")) {
        this.$inertia.put(this.route("menus.restore", this.menu.id));
      }
    },
  },
};
</script>
