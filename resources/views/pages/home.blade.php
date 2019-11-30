@extends('layouts.default')

@section('default-head')
    <title>Tiago Mendes</title>
@endsection

@section('default-body')
    <div id="particles-js">
        <canvas class="particles-js-canvas-el" style="width: 100%; height: 100%;"></canvas>
    </div>

    <div class="loader do-not-select" id="loader" style="cursor: wait">

        <div class="loader-animation" id="loader-animation">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="page">
        <section class="info">

            <h1>Tiago Mendes</h1>

            <p class="flow-text"><i class="fa fa-map-marker" aria-hidden="true"></i> Barcelos, Portugal</p>
            <p class="flow-text"><a href="mailto:tiago@mendes.com.pt"><i class="fa fa-envelope-o"
                                                                         aria-hidden="true"></i> tiago@mendes.com.pt</a>
            </p>
            <p class="flow-text"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Engenharia de Sistemas
                Informaticos</p>
            <p class="flow-text"><i class="fa fa-language" aria-hidden="true"></i> Português, English</p>
            <p class="flow-text"><i class="fa fa-birthday-cake" aria-hidden="true"></i> {{ $age }} anos</p>

            <div class="out-btn-links">
                <a href="https://linkedin.com/in/tiago-sousa-mendes">
                    <i class="fab fa-linkedin"></i>
                </a>

                <a href="https://github.com/tiagoomendess">
                    <i class="fab fa-github-square"></i>
                </a>
            </div>

        </section>
    </div>
@endsection