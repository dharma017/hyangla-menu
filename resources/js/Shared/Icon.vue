<template>
  <svg
    v-if="name === 'apple'"
    xmlns="http://www.w3.org/2000/svg"
    width="100"
    height="100"
    viewBox="0 0 100 100"
  >
    <g fill-rule="nonzero">
      <path
        d="M46.173 19.967C49.927-1.838 19.797-.233 14.538.21c-.429.035-.648.4-.483.8 2.004 4.825 14.168 31.66 32.118 18.957zm13.18 1.636c1.269-.891 1.35-1.614.047-2.453l-2.657-1.71c-.94-.607-1.685-.606-2.532.129-5.094 4.42-7.336 9.18-8.211 15.24 1.597.682 3.55.79 5.265.328 1.298-4.283 3.64-8.412 8.088-11.534z"
      />
      <path
        d="M88.588 67.75c9.65-27.532-13.697-45.537-35.453-32.322-1.84 1.118-4.601 1.118-6.441 0-21.757-13.215-45.105 4.79-35.454 32.321 5.302 15.123 17.06 39.95 37.295 29.995.772-.38 1.986-.38 2.758 0 20.235 9.955 31.991-14.872 37.295-29.995z"
      />
    </g>
  </svg>
  <svg
    v-else-if="name === 'book'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  >
    <path
      d="M6 4H5a1 1 0 1 1 0-2h11V1a1 1 0 0 0-1-1H4a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V5a1 1 0 0 0-1-1h-7v8l-2-2-2 2V4z"
    />
  </svg>
  <svg
    v-else-if="name === 'cheveron-down'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  >
    <path
      d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
    />
  </svg>
  <svg
    v-else-if="name === 'cheveron-right'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  >
    <polygon
      points="12.95 10.707 13.657 10 8 4.343 6.586 5.757 10.828 10 6.586 14.243 8 15.657 12.95 10.707"
    />
  </svg>
  <svg
    v-else-if="name === 'dashboard'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  >
    <path
      d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm-5.6-4.29a9.95 9.95 0 0 1 11.2 0 8 8 0 1 0-11.2 0zm6.12-7.64l3.02-3.02 1.41 1.41-3.02 3.02a2 2 0 1 1-1.41-1.41z"
    />
  </svg>
  <svg
    v-else-if="name === 'location'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  >
    <path
      d="M10 20S3 10.87 3 7a7 7 0 1 1 14 0c0 3.87-7 13-7 13zm0-11a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"
    />
  </svg>
  <svg
    v-else-if="name === 'office'"
    xmlns="http://www.w3.org/2000/svg"
    width="100"
    height="100"
    viewBox="0 0 100 100"
  >
    <path
      fill-rule="evenodd"
      d="M7 0h86v100H57.108V88.418H42.892V100H7V0zm9 64h11v15H16V64zm57 0h11v15H73V64zm-19 0h11v15H54V64zm-19 0h11v15H35V64zM16 37h11v15H16V37zm57 0h11v15H73V37zm-19 0h11v15H54V37zm-19 0h11v15H35V37zM16 11h11v15H16V11zm57 0h11v15H73V11zm-19 0h11v15H54V11zm-19 0h11v15H35V11z"
    />
  </svg>
  <svg
    v-else-if="name === 'printer'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  >
    <path
      d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
    />
  </svg>
  <svg
    v-else-if="name === 'shopping-cart'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  >
    <path
      d="M4 2h16l-3 9H4a1 1 0 1 0 0 2h13v2H4a3 3 0 0 1 0-6h.33L3 5 2 2H0V0h3a1 1 0 0 1 1 1v1zm1 18a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm10 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"
    />
  </svg>
  <svg
    v-else-if="name === 'store-front'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  >
    <path
      d="M18 9.87V20H2V9.87a4.25 4.25 0 0 0 3-.38V14h10V9.5a4.26 4.26 0 0 0 3 .37zM3 0h4l-.67 6.03A3.43 3.43 0 0 1 3 9C1.34 9 .42 7.73.95 6.15L3 0zm5 0h4l.7 6.3c.17 1.5-.91 2.7-2.42 2.7h-.56A2.38 2.38 0 0 1 7.3 6.3L8 0zm5 0h4l2.05 6.15C19.58 7.73 18.65 9 17 9a3.42 3.42 0 0 1-3.33-2.97L13 0z"
    />
  </svg>
  <svg
    v-else-if="name === 'trash'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  >
    <path
      d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"
    />
  </svg>
  <svg
    v-else-if="name === 'users'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 20 20"
  >
    <path
      d="M7 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1c2.15 0 4.2.4 6.1 1.09L12 16h-1.25L10 20H4l-.75-4H2L.9 10.09A17.93 17.93 0 0 1 7 9zm8.31.17c1.32.18 2.59.48 3.8.92L18 16h-1.25L16 20h-3.96l.37-2h1.25l1.65-8.83zM13 0a4 4 0 1 1-1.33 7.76 5.96 5.96 0 0 0 0-7.52C12.1.1 12.53 0 13 0z"
    />
  </svg>
  <svg
    v-else-if="name === 'edit'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
  >
    <path d="M0 0h24v24H0z" fill="none" />
    <path
      d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"
    />
  </svg>
  <svg
    v-else-if="name === 'preview'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
  >
    <g>
      <rect fill="none" height="24" width="24" />
      <path
        d="M19,3H5C3.89,3,3,3.9,3,5v14c0,1.1,0.89,2,2,2h14c1.1,0,2-0.9,2-2V5C21,3.9,20.11,3,19,3z M19,19H5V7h14V19z M12,10.5 c1.84,0,3.48,0.96,4.34,2.5c-0.86,1.54-2.5,2.5-4.34,2.5S8.52,14.54,7.66,13C8.52,11.46,10.16,10.5,12,10.5 M12,9 c-2.73,0-5.06,1.66-6,4c0.94,2.34,3.27,4,6,4s5.06-1.66,6-4C17.06,10.66,14.73,9,12,9L12,9z M12,14.5c-0.83,0-1.5-0.67-1.5-1.5 s0.67-1.5,1.5-1.5s1.5,0.67,1.5,1.5S12.83,14.5,12,14.5z"
      />
    </g>
  </svg>
  <svg
    v-else-if="name === 'view'"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
  >
    <path d="M0 0h24v24H0V0z" fill="none" />
    <path
      d="M11.49 16c.88 0 1.7-.26 2.39-.7l2.44 2.44 1.42-1.42-2.44-2.43c.44-.7.7-1.51.7-2.39C16 9.01 13.99 7 11.5 7S7 9.01 7 11.5 9.01 16 11.49 16zm.01-7c1.38 0 2.5 1.12 2.5 2.5S12.88 14 11.5 14 9 12.88 9 11.5 10.12 9 11.5 9zM20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V6h16v12z"
    />
  </svg>
</template>

<script>
export default {
  props: {
    name: String,
  },
};
</script>
