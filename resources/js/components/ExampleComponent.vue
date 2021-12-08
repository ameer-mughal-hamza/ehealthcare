<template>
    <div class="col-lg-12">
        <div class="ibox">
            <div class="text-center">
                    <textarea name="post" placeholder="What's on your mind?" class="form-control" id="post" cols="30"
                              rows="5"></textarea>
            </div>
            <div class="text-right">
                <button class="mt-2 btn btn-primary">Post!</button>
            </div>
        </div>
        <div class="social-feed-box">
            <div v-for="post in posts">
                <div class="social-avatar">
                    <a href="" class="float-left">
                        <img alt="image" src="img/a1.jpg"/>
                    </a>
                    <div class="media-body">
                        <a href="#">{{ post.user.name }}</a>
                        <small class="text-muted">{{ post.time }} - {{ post.date_created }}</small>
                    </div>
                </div>
                <div class="social-body">
                    <p>
                        {{ post.description }}
                    </p>

                    <div class="btn-group">
                        <button class="btn btn-white btn-xs">
                            <i class="fa fa-thumbs-up"></i> Like this!
                        </button>
                        <button class="btn btn-white btn-xs">
                            <i class="fa fa-comments"></i> Comment
                        </button>
                    </div>
                </div>
                <div class="social-footer">
                    <div class="social-comment" v-for="comment in post.comments">
                        <a href="" class="float-left">
                            <img alt="image" src="img/a1.jpg"/>
                        </a>
                        <div class="media-body">
                            <a href="#">{{ comment.name }}</a>
                            {{ comment.description }}
                            <br/>
                            <a href="#" class="small"
                            ><i class="fa fa-thumbs-up"></i> 26 Like this!</a
                            >
                            -
                            <small class="text-muted">{{ comment.time }} - {{ comment.date_created }}</small>
                        </div>
                    </div>
                    <div class="social-comment">
                        <a href="" class="float-left">
                            <img alt="image" src="img/a3.jpg"/>
                        </a>
                        <div class="media-body">
                      <textarea
                          id="comment" name="comment"
                          v-model="comment"
                          class="form-control"
                          placeholder="Write comment..."
                      ></textarea>
                            <div v-if="errors && errors.message" class="text-danger">{{ errors.message[0] }}</div>
                        </div>
                        <div class="text-right">
                            <button class="mt-2 btn btn-primary btn-xs" v-on:click="postComment(post.id)">Post!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.fetchPosts();
    },
    data() {
        return {
            posts: [],
            comment: "",
            errors: {}
        }
    },
    methods: {
        fetchPosts() {
            axios.get('/api/blogs').then(response => {
                console.log(JSON.parse(response.data.slice(2)));
                this.posts = JSON.parse(response.data.slice(2));
                console.log(this.posts)
            });
        },
        postComment(post_id) {
            console.log(this.comment);
            this.errors = {};
            axios.post('api/blogs', {
                post_id: post_id,
                comment: this.comment
            }).then(response => {
                this.comment = "";
                console.log(JSON.parse(response.data.slice(2)));
                console.log(this.posts);
                console.log(this.posts.comments);
                this.posts.comments.push(JSON.parse(response.data.slice(2)))
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                }
            });
        },
    }
}
</script>
