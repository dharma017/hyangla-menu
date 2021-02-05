<template>
  <div>
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <vue-editor
      :id="id"
      ref="input"
      v-model="content"
      v-bind="$attrs"
      :class="{ error: error }"
      :editor-toolbar="customToolbar"
    />
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";

export default {
  components: { VueEditor },
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      default() {
        return `text-editor-${this._uid}`;
      },
    },
    value: String,
    label: String,
    error: String,
  },
  data() {
    return {
      content: this.value,
      customToolbar: [
        ["bold", "italic", "underline"],
        // [{ list: "ordered" }, { list: "bullet" }],
        // ["image", "code-block"],
      ],
    };
  },
  methods: {
    focus() {
      this.$refs.input.focus();
    },
    select() {
      this.$refs.input.select();
    },
  },
};
</script>
