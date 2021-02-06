<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link
        class="text-indigo-400 hover:text-indigo-600"
        :href="route('organizations')"
        >Organizations</inertia-link
      >
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
    </h1>
    <trashed-message
      v-if="organization.deleted_at"
      class="mb-6"
      @restore="restore"
    >
      This organization has been deleted.
    </trashed-message>
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
          <select-input
            v-model="form.enable_marketing"
            :error="errors.enable_marketing"
            class="pr-6 pb-8 w-full lg:w"
            label="Enable Marketing"
          >
            <option :value="true">Yes</option>
            <option :value="false">No</option>
          </select-input>
          <file-input
            v-model="form.image"
            :error="errors.image"
            class="pr-6 pb-8 w-full lg:w-1/2"
            type="file"
            accept="image/*"
            label="Image"
          />
          <img
            v-if="organization.image"
            class="pr-6 pb-8 w-full lg:w-1/6"
            :src="organization.image"
          />
          <file-input
            v-model="form.marketing_image"
            :error="errors.marketing_image"
            class="pr-6 pb-8 w-full lg:w-1/2"
            type="file"
            accept="image/*"
            label="Marketing Image"
          />
          <img
            v-if="organization.marketing_image"
            class="pr-6 pb-8 w-full lg:w-1/6"
            :src="organization.marketing_image"
          />
        </div>
        <div
          class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center"
        >
          <button
            v-if="!organization.deleted_at"
            class="text-red-600 hover:underline"
            tabindex="-1"
            type="button"
            @click="destroy"
          >
            Delete Organization
          </button>
          <loading-button
            :loading="sending"
            class="btn-indigo ml-auto"
            type="submit"
            >Update Organization</loading-button
          >
        </div>
      </form>
    </div>
    <h2 class="mt-12 font-bold text-2xl">Contacts</h2>
    <div class="mt-6 bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">Name</th>
          <th class="px-6 pt-6 pb-4">City</th>
          <th class="px-6 pt-6 pb-4" colspan="2">Phone</th>
        </tr>
        <tr
          v-for="contact in organization.contacts"
          :key="contact.id"
          class="hover:bg-gray-100 focus-within:bg-gray-100"
        >
          <td class="border-t">
            <inertia-link
              class="px-6 py-4 flex items-center focus:text-indigo-500"
              :href="route('contacts.edit', contact.id)"
            >
              {{ contact.name }}
              <icon
                v-if="contact.deleted_at"
                name="trash"
                class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2"
              />
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link
              class="px-6 py-4 flex items-center"
              :href="route('contacts.edit', contact.id)"
              tabindex="-1"
            >
              {{ contact.city }}
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link
              class="px-6 py-4 flex items-center"
              :href="route('contacts.edit', contact.id)"
              tabindex="-1"
            >
              {{ contact.phone }}
            </inertia-link>
          </td>
          <td class="border-t w-px">
            <inertia-link
              class="px-4 flex items-center"
              :href="route('contacts.edit', contact.id)"
              tabindex="-1"
            >
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </inertia-link>
          </td>
        </tr>
        <tr v-if="organization.contacts.length === 0">
          <td class="border-t px-6 py-4" colspan="4">No contacts found.</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import Icon from "@/Shared/Icon";
import Layout from "@/Shared/Layout";
import LoadingButton from "@/Shared/LoadingButton";
import SelectInput from "@/Shared/SelectInput";
import TextInput from "@/Shared/TextInput";
import TrashedMessage from "@/Shared/TrashedMessage";
import FileInput from "@/Shared/FileInput";

export default {
  metaInfo() {
    return { title: this.form.name };
  },
  layout: Layout,
  components: {
    Icon,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
    FileInput,
  },
  props: {
    errors: Object,
    organization: Object,
  },
  remember: "form",
  data() {
    return {
      sending: false,
      form: {
        name: this.organization.name,
        email: this.organization.email,
        phone: this.organization.phone,
        address: this.organization.address,
        city: this.organization.city,
        region: this.organization.region,
        country: this.organization.country,
        postal_code: this.organization.postal_code,
        image: null,
        marketing_image: null,
        enable_marketing: this.organization.enable_marketing,
      },
    };
  },
  created() {
    // console.log(
    //   "🚀 ~ file: Edit.vue ~ line 221 ~ data ~ this.organization",
    //   this.organization.marketing_image
    // );
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
      data.append("_method", "put");

      this.$inertia.post(
        this.route("organizations.update", this.organization.id),
        data,
        {
          onStart: () => (this.sending = true),
          onFinish: () => (this.sending = false),
          onSuccess: () => {
            if (Object.keys(this.$page.errors).length === 0) {
              this.form.image = null;
              this.form.marketing_image = null;
            }
          },
        }
      );
    },
    destroy() {
      if (confirm("Are you sure you want to delete this organization?")) {
        this.$inertia.delete(
          this.route("organizations.destroy", this.organization.id)
        );
      }
    },
    restore() {
      if (confirm("Are you sure you want to restore this organization?")) {
        this.$inertia.put(
          this.route("organizations.restore", this.organization.id)
        );
      }
    },
  },
};
</script>
