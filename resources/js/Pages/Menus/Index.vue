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
          <th class="px-6 pt-6 pb-4">ID</th>
          <th class="px-6 pt-6 pb-4">Title</th>
          <th class="px-6 pt-6 pb-4">Size</th>
          <th class="px-6 pt-6 pb-4">Marketing Size</th>
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
              class="px-6 py-4 flex items-center"
              :href="route('menus.edit', menu.id)"
              tabindex="-1"
            >
              {{ menu.id }}
            </inertia-link>
          </td>
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
              {{ menu.image_file_size }}
            </inertia-link>
          </td>

          <td class="border-t">
            <inertia-link
              class="px-6 py-4 flex items-center"
              :href="route('menus.edit', menu.id)"
              tabindex="-1"
            >
              {{ menu.marketing_image_file_size }}
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
    <marketing-modal :showing="isOpen" @close="isOpen = false">
      <div class="shadow-2xl bg-semi-75 px-4 py-3 sm:px-6 sm:flex">
        <div v-html="description" class="wrap-body"></div>
      </div>
    </marketing-modal>
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
import MarketingModal from "@/Shared/MarketingModal";

export default {
  metaInfo: { title: "Menus" },
  layout: Layout,
  components: {
    Icon,
    Pagination,
    SearchFilter,
    MarketingModal,
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
  },
};
</script>
