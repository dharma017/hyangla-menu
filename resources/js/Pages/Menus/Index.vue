<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Menus</h1>
    <div class="mb-6 flex justify-between items-center">
      <search-filter
        v-model="form.search"
        class="w-full max-w-md mr-4"
        @reset="reset"
      >
        <label class="block text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="mt-1 w-full form-select">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter>
      <inertia-link class="btn-indigo" :href="route('menus.create')">
        <span>Create</span>
        <span class="hidden md:inline">Menu</span>
      </inertia-link>
    </div>
    <div class="bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">Title</th>
          <th class="px-6 pt-6 pb-4">Status</th>
          <th class="px-6 pt-6 pb-4" colspan="3">Action</th>
        </tr>
        <tr
          v-for="menu in menus.data"
          :key="menu.id"
          class="hover:bg-gray-100 focus-within:bg-gray-100"
        >
          <td class="border-t">
            <inertia-link
              class="px-6 py-4 flex items-center focus:text-indigo-500"
              :href="route('menus.edit', menu.id)"
            >
              <img
                v-if="menu.image"
                class="block w-5 h-5 rounded-full mr-2 -my-2"
                :src="menu.image"
              />
              {{ menu.title }}
              <icon
                v-if="menu.deleted_at"
                name="trash"
                class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2"
              />
            </inertia-link>
          </td>

          <td class="border-t">
            <inertia-link
              class="px-6 py-4 flex items-center"
              :href="route('menus.edit', menu.id)"
              tabindex="-1"
            >
              {{ menu.status ? "Active" : "Inactive" }}
            </inertia-link>
          </td>
          <td class="border-t w-px">
            <inertia-link
              class="px-5 flex items-center"
              :href="route('menus.edit', menu.id)"
              tabindex="-1"
            >
              <icon name="edit" class="block w-6 h-6 fill-gray-400" />
            </inertia-link>
          </td>
          <td class="border-t w-px">
            <a
              class="text-sm"
              href="#"
              @click.stop="openModal(menu.description)"
            >
              <icon name="view" class="block w-6 h-6 fill-gray-400" />
            </a>
          </td>
          <td class="border-t w-px">
            <a
              class="px-5 flex items-center"
              target="_blank"
              :href="route('home.show', menu.slug)"
              tabindex="-1"
            >
              <icon name="tab" class="block w-6 h-6 fill-gray-400" />
            </a>
          </td>
        </tr>
        <tr v-if="menus.data.length === 0">
          <td class="border-t px-6 py-4" colspan="4">No menus found.</td>
        </tr>
      </table>
    </div>
    <pagination :links="menus.links" />
    <div
      class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400"
      v-if="isOpen"
    >
      <div
        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
      >
        <div class="fixed inset-0 transition-opacity">
          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span
        >​
        <div
          class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
          role="dialog"
          aria-modal="true"
          aria-labelledby="modal-headline"
        >
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex">
            <div v-html="description" class="wrap-body"></div>
          </div>
          <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button
              @click="closeModal()"
              type="button"
              class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
            >
              Close
            </button>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Icon from "@/Shared/Icon";
import Layout from "@/Shared/Layout";
import mapValues from "lodash/mapValues";
import Pagination from "@/Shared/Pagination";
import pickBy from "lodash/pickBy";
import SearchFilter from "@/Shared/SearchFilter";
import throttle from "lodash/throttle";

export default {
  metaInfo: { title: "Menus" },
  layout: Layout,
  components: {
    Icon,
    Pagination,
    SearchFilter,
  },
  props: {
    menus: Object,
    filters: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
      isOpen: false,
      description: "",
    };
  },
  watch: {
    form: {
      handler: throttle(function () {
        let query = pickBy(this.form);
        this.$inertia.replace(
          this.route(
            "menus",
            Object.keys(query).length ? query : { remember: "forget" }
          )
        );
      }, 150),
      deep: true,
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null);
    },
    openModal(description) {
      this.isOpen = true;
      this.description = description;
    },
    closeModal() {
      this.description = "";
      this.isOpen = false;
    },
  },
};
</script>

<style scoped>
.wrap-body {
  white-space: pre-wrap;
}
</style>