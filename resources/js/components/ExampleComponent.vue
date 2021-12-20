<template>
    <div class="col-lg-12 mt90">
        <div class="ibox">
            <div class="text-center">
                    <textarea name="post" v-model="description" placeholder="What's on your mind?" class="form-control"
                              id="post" cols="30"
                              rows="5"></textarea>
            </div>
            <div class="text-right">
                <button @click="submitPost" class="mt-2 btn btn-primary">Post!</button>
            </div>
        </div>
        <div v-for="post in posts">
            <div class="social-feed-box">
                <div class="social-avatar">
                    <a href="" class="float-left">
                        <img alt="image" src="img/a1.jpg"/>
                    </a>
                    <div class="media-body">
                        <h4>{{ post.user.name }}</h4>
                        <small class="text-muted">{{ post.time }} - {{ post.date_created }}</small>
                    </div>
                </div>
                <div class="social-body">
                    <p>
                        <a class="no-design" :href="`/post/${post.id}`">{{ post.description }}</a>
                    </p>
                </div>
                <div class="social-footer" v-if="post.comments.length">
                    <div class="social-comment" v-for="comment in post.comments">
                        <a href="" class="float-left">
                            <img alt="image" src="img/a1.jpg"/>
                        </a>
                        <div class="media-body">
                            <a href="#" class="no-design">{{ comment.name }}</a>
                            <p>{{ comment.description }}</p>
                            <small class="text-muted">{{ comment.time }} - {{ comment.date_created }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.no-design {
    text-decoration: none !important;
    color: black;
}

.mt90 {
    margin-top: 90px !important;
}
</style>

<script>
export default {
    props: ['user'],
    mounted() {
        this.fetchPosts();
    },
    data() {
        return {
            posts: [],
            comment: "",
            errors: {},
            description: ""
        }
    },
    methods: {
        fetchPosts() {
            axios.get('/api/blogs').then(response => {
                this.posts = response.data;
            });
        },
        submitPost() {
            const user_id = JSON.parse(this.user).id;
            axios.post('api/post/submit', {
                description: this.description,
                user_id: user_id
            }).then(response => {
                this.posts.push(response.data);
                console.log(this.posts);
                this.description = "";
            }).catch(error => {
                window.location.reload;
            });
        },
        postComment(post_id) {
            this.errors = {};
            axios.post('api/blogs', {
                post_id: post_id,
                comment: this.comment
            }).then(response => {
                this.comment = "";
                this.posts.comments.push(response.data)
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                }
            });
        },
    }
}
</script>
