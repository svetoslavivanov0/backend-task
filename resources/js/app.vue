<template>
  <div>
    <div id="nav">
      <router-link class="text-yellow-700" to="/">Home</router-link> |

      <router-link class="text-yellow-700" to="/create-payment">Create Payment</router-link> |

      <router-link class="text-yellow-700" to="/create-credit">Credit Requests</router-link> |
    </div>

    <router-view />
  </div>
</template>