<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link
        class="text-indigo-400 hover:text-indigo-600"
        :href="route('organizations')"
        >Organizations</inertia-link
      >
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="submit">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input
            v-model="form.name"
            :error="errors.name"
            class="pr-6 pb-8 w-full lg:w-1/2"
            label="Name"
          />
          <text-input
            v-model="form.email"
            :error="errors.email"
            class="pr-6 pb-8 w-full lg:w-1/2"
            label="Email"
          />
          <text-input
            v-model="form.phone"
            :error="errors.phone"
            class="pr-6 pb-8 w-full lg:w-1/2"
            label="Phone"
          />
          <text-input
            v-model="form.address"
            :error="errors.address"
            class="pr-6 pb-8 w-full lg:w-1/2"
            label="Address"
          />
          <text-input
            v-model="form.city"
            :error="errors.city"
            class="pr-6 pb-8 w-full lg:w-1/2"
            label="City"
          />
          <text-input
            v-model="form.region"
            :error="errors.region"
            class="pr-6 pb-8 w-full lg:w-1/2"
            label="Province/State"
          />
          <select-input
            v-model="form.country"
            :error="errors.country"
            class="pr-6 pb-8 w-full lg:w-1/2"
            label="Country"
          >
            <option :value="null" />
            <option value="NP">Nepal</option>
          </select-input>
          <text-input
            v-model="form.postal_code"
            :error="errors.postal_code"
            class="pr-6 pb-8 w-full lg:w-1/2"
            label="Postal code"
          />
          <file-input
            v-model="form.image"
            :error="errors.image"
            class="pr-6 pb-8 w-full lg:w-1/2"
            type="file"
            accept="image/*"
            label="Image"
          />
          <file-input
            v-model="form.marketing_image"
            :error="errors.marketing_image"
            class="pr-6 pb-8 w-full lg:w-1/2"
            type="file"
            accept="image/*"
            label="Marketing Image"
          />
          <select-input
            v-model="form.enable_marketing"
            :error="errors.enable_marketing"
            class="pr-6 pb-8 w-full lg:w-1/2"
            label="Enable Marketing"
          >
            <option :value="true">Yes</option>
            <option :value="false">No</option>
          </select-input>
        </div>
        <div
          class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center"
        >
          <loading-button :loading="sending" class="btn-indigo" type="submit"
            >Create Organization</loading-button
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

export default {
  metaInfo: { title: "Create Organization" },
  layout: Layout,
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    FileInput,
  },
  props: {
    errors: Object,
  },
  remember: "form",
  data() {
    return {
      sending: false,
      form: {
        name: null,
        email: null,
        phone: null,
        address: null,
        city: null,
        region: null,
        country: null,
        postal_code: null,
        enable_marketing: false,
        image: null,
        marketing_image: null,
      },
    };
  },
  methods: {
    submit() {
      const data = new FormData();
      data.append("name", this.form.name || "");
      data.append("email", this.form.email || "");
      data.append("phone", this.form.phone || "");
      data.append("address", this.form.address || "");
      data.append("city", this.form.city || "");
      data.append("region", this.form.region || "");
      data.append("country", this.form.country || "");
      data.append("postal_code", this.form.postal_code || "");
      data.append("image", this.form.image || "");
      data.append("marketing_image", this.form.marketing_image || "");
      data.append("enable_marketing", this.form.enable_marketing ? "1" : "0");

      this.$inertia.post(this.route("organizations.store"), data, {
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },
  },
};
</script>
