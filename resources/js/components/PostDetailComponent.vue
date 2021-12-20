<template>
    <div class="col-lg-12 mt90">
        <div class="social-feed-box">
            <div class="social-avatar">
                <a href="" class="float-left">
                    <img alt="image" src="http://localhost:8000/img/a1.jpg"/>
                </a>
                <div class="media-body">
                    <small class="text-muted">{{ post.time }} - {{ post.date_created }}</small>
                </div>
            </div>
            <div class="social-body">
                <p>
                    {{ post.description }}
                </p>
            </div>
            <div class="social-footer">
                <div class="social-comment" v-for="comment in post.comments">
                    <a href="" class="float-left">
                        <img alt="image" src="http://localhost:8000/img/a1.jpg"/>
                    </a>
                    <div class="media-body">
                        <a href="#" class="no-design">{{ comment.name }}</a>
                        <br>
                        {{ comment.description }}
                        <br/>
                        <small class="text-muted">
                            {{ comment.time }} - {{ comment.date_created }}
                        </small>
                    </div>
                </div>
                <div class="social-comment">
                    <a href="" class="float-left">
                        <img alt="image" src="http://localhost:8000/img/a1.jpg"/>
                    </a>
                    <div class="media-body">
                      <textarea
                          id="comment" name="comment"
                          v-model="comment"
                          class="form-control"
                          placeholder="Write comment..."
                      ></textarea>
                        <div v-if="errors && errors.description" class="text-danger">{{ errors.description[0] }}</div>
                    </div>
                    <div class="text-right">
                        <button class="mt-2 btn btn-primary btn-xs" v-on:click="postComment(post.id)">Post!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.mt90 {
    margin-top: 90px !important;
}
</style>

<script>
export default {
    props: ['user'],
    data() {
        return {
            post: {},
            comment: "",
            errors: {},
            id: ""
        }
    },
    methods: {
        fetchPosts() {
            const url = new URL(window.location.href);
            const url_param = url.pathname.split('/');
            axios.get(`/api/blogs/${url_param[2]}`).then(response => {
                this.post = response.data;
            });
        },
        postComment(post_id) {
            this.errors = {};
            axios.post('/api/blogs', {
                post_id: post_id,
                comment: this.comment
            }).then(response => {
                console.log(this.post.comments);
                console.log(response.data);
                this.comment = "";
                this.post.comments.push(response.data);
                console.log(this.post.comments);
            }).catch(error => {
                const trimString = error.response.data;
                if (error.response.status === 422) {
                    this.errors = trimString.errors || {};
                }
            });
        }
    },
    mounted() {
        this.fetchPosts();
        Echo.private('post').listen('PostEvent', (e) => {
            this.post.comments.push(e.obj);
        });
    }
}
</script>
