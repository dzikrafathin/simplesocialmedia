<template>
    <v-list
        nav
        dense
    >
        <template v-if="loading">
            <v-skeleton-loader
                class="mx-auto"
                type="list-item-avatar"
            ></v-skeleton-loader>
        </template>
        <template v-else>
            <user-list-item 
                v-for="user in daftarUser"
                :key="user.id"
                :user="user"
            />
        </template>
    </v-list>
</template>

<script>
import RepoFactory from '../../repositories/RepoFactory'
import UserListItem from './UserListItem'

const userRepo = RepoFactory.get('user')

export default {
    data : () => ({
        daftarUser : [],
        loading : false
    }),
    components : {
        UserListItem
    },
    created() {
        this.loading = true
        userRepo.index()
        .then(res => {
            this.daftarUser = res.data
            this.loading = false
        })
    }
}
</script>