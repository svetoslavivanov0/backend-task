<template>
  <div>
    <div id="nav">
      <router-link class="text-yellow-700" to="/">Home</router-link> |

      <router-link class="text-yellow-700" to="/create-payment">Create a Payment</router-link> |

      <router-link class="text-yellow-700" to="/create-credit">Add a Request</router-link>
    </div>

    <router-view />
  </div>
</template>