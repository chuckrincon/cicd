@extends('layouts.master')
@section('css')


    <style type="text/css">
        /*
        * jQuery OrgChart Plugin
        * https://github.com/dabeng/OrgChart
        *
        * Copyright 2016, dabeng
        * https://github.com/dabeng
        *
        * Licensed under the MIT license:
        * http://www.opensource.org/licenses/MIT
        */

        .orgchart {
            box-sizing: border-box;
            display: inline-block;
            min-height: 202px;
            min-width: 202px;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px dashed rgba(0,0,0,0);
            padding: 20px;
        }

        .orgchart .hidden, .orgchart~.hidden {
            display: none;
        }

        .orgchart.b2t {
            transform: rotate(180deg);
        }

        .orgchart.l2r {
            position: absolute;
            transform: rotate(-90deg) rotateY(180deg);
            transform-origin: left top;
        }

        .orgchart .verticalNodes ul {
            list-style: none;
            margin: 0;
            padding-left: 18px;
            text-align: left;
        }
        .orgchart .verticalNodes ul:first-child {
            margin-top: 2px;
        }
        .orgchart .verticalNodes>td::before {
            content: '';
            border: 1px solid #1999E3;
        }
        .orgchart .verticalNodes>td>ul>li:first-child::before {
            box-sizing: border-box;
            top: -4px;
            height: 30px;
            width: calc(50% - 2px);
            border-width: 2px 0 0 2px;
        }
        .orgchart .verticalNodes ul>li {
            position: relative;
        }
        .orgchart .verticalNodes ul>li::before,
        .orgchart .verticalNodes ul>li::after {
            box-sizing: border-box;
            content: '';
            position: absolute;
            left: -6px;
            border-color: #1999E3;
            border-style: solid;
            border-width: 0 0 2px 2px;
        }
        .orgchart .verticalNodes ul>li::before {
            top: -4px;
            height: 30px;
            width: 11px;
        }
        .orgchart .verticalNodes ul>li::after {
            top: 1px;
            height: 100%;
        }
        .orgchart .verticalNodes ul>li:first-child::after {
            box-sizing: border-box;
            top: 24px;
            width: 11px;
            border-width: 2px 0 0 2px;
        }
        .orgchart .verticalNodes ul>li:last-child::after {
            box-sizing: border-box;
            border-width: 2px 0 0;
        }

        .orgchart.r2l {
            position: absolute;
            transform: rotate(90deg);
            transform-origin: left top;
        }

        .orgchart>.spinner {
            font-size: 100px;
            margin-top: 30px;
            color: rgba(68, 157, 68, 0.8);
        }

        .orgchart table {
            border-spacing: 0;
            border-collapse: separate;
        }

        .orgchart>table:first-child{
            margin: 20px auto;
        }

        .orgchart td {
            text-align: center;
            vertical-align: top;
            padding: 0 1px 0 0;
        }

        .orgchart .lines:nth-child(3) td {
            box-sizing: border-box;
            height: 20px;
        }

        .orgchart .lines .topLine {
            border-top: 2px solid #1999E3;
        }

        .orgchart .lines .rightLine {
            border-right: 1px solid #1999E3;
            float: none;
            border-radius: 0;
        }

        .orgchart .lines .leftLine {
            border-left: 1px solid #1999E3;
            float: none;
            border-radius: 0;
        }

        .orgchart .lines .downLine {
            background-color: #1999E3;
            margin: 0 auto;
            height: 20px;
            width: 2px;
            float: none;
        }

        /* node styling */
        .orgchart .node {
            box-sizing: border-box;
            display: inline-block;
            position: relative;
            margin: 0;
            padding: 3px;
            border: 2px dashed transparent;
            text-align: center;
            width: 130px;
        }

        .orgchart.l2r .node, .orgchart.r2l .node {
            width: 50px;
            height: 130px;
        }

        .orgchart .node>.spinner {
            position: absolute;
            top: calc(50% - 15px);
            left: calc(50% - 15px);
            vertical-align: middle;
            font-size: 30px;
            color: rgba(68, 157, 68, 0.8);
        }

        .orgchart .node:hover {
            background-color: rgba(238, 217, 54, 0.5);
            transition: .5s;
            cursor: default;
            z-index: 20;
        }

        .orgchart .node.focused {
            background-color: rgba(238, 217, 54, 0.5);
        }

        .orgchart .ghost-node {
            position: fixed;
            left: -10000px;
            top: -10000px;
        }

        .orgchart .ghost-node rect {
            fill: #ffffff;
            stroke: #bf0000;
        }

        .orgchart .node.allowedDrop {
            border-color: rgba(68, 157, 68, 0.9);
        }

        .orgchart .node .title {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            height: 40px;
            line-height: 40px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            background-color: #1999E3;
            color: #fff;

        }

        .orgchart.b2t .node .title {
            transform: rotate(-180deg);
            transform-origin: center bottom;
        }

        .orgchart.l2r .node .title {
            transform: rotate(-90deg) translate(-40px, -40px) rotateY(180deg);
            transform-origin: bottom center;
            width: 120px;
        }

        .orgchart.r2l .node .title {
            transform: rotate(-90deg) translate(-40px, -40px);
            transform-origin: bottom center;
            width: 120px;
        }

        .orgchart .node .title .symbol {

            display: none;
        }

        .orgchart .node .content {
            box-sizing: border-box;
            width: 100%;
            height: 20px;
            font-size: 11px;
            line-height: 18px;
            border: 1px solid #1999E3;
            border-radius: 0 0 4px 4px;
            text-align: center;
            background-color: #fff;
            color: #333;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .orgchart.b2t .node .content {
            transform: rotate(180deg);
            transform-origin: center top;
        }

        .orgchart.l2r .node .content {
            transform: rotate(-90deg) translate(-40px, -40px) rotateY(180deg);
            transform-origin: top center;
            width: 120px;
        }

        .orgchart.r2l .node .content {
            transform: rotate(-90deg) translate(-40px, -40px);
            transform-origin: top center;
            width: 120px;
        }

        .orgchart .node .edge {
            font-size: 15px;
            position: absolute;
            color: rgba(68, 157, 68, 0.5);
            cursor: default;
            transition: .2s;
        }

        .orgchart.noncollapsable .node .edge {
            display: none;
        }

        .orgchart .edge:hover {
            color: #449d44;
            cursor: pointer;
        }

        .orgchart .node .verticalEdge {
            width: calc(100% - 10px);
            width: -webkit-calc(100% - 10px);
            width: -moz-calc(100% - 10px);
            left: 5px;
        }

        .orgchart .node .topEdge {
            top: -4px;
        }

        .orgchart .node .bottomEdge {
            bottom: -4px;
        }

        .orgchart .node .horizontalEdge {
            width: 15px;
            height: calc(100% - 10px);
            height: -webkit-calc(100% - 10px);
            height: -moz-calc(100% - 10px);
            top: 5px;
        }

        .orgchart .node .rightEdge {
            right: -4px;
        }

        .orgchart .node .leftEdge {
            left: -4px;
        }

        .orgchart .node .horizontalEdge::before {
            position: absolute;
            top: calc(50% - 7px);
        }

        .orgchart .node .rightEdge::before {
            right: 3px;
        }

        .orgchart .node .leftEdge::before {
            left: 3px;
        }

        .orgchart .node .toggleBtn {
            position: absolute;
            left: 5px;
            bottom: -2px;
            color: rgba(68, 157, 68, 0.6);
        }

        .orgchart .node .toggleBtn:hover {
            color: rgba(68, 157, 68, 0.8);
        }

        .oc-export-btn {
            display: inline-block;
            position: absolute;
            right: 5px;
            top: 5px;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            touch-action: manipulation;
            cursor: pointer;
            user-select: none;
            color: #fff;
            background-color: #5cb85c;
            border: 1px solid transparent;
            border-color: #4cae4c;
            border-radius: 4px;
        }

        .oc-export-btn[disabled] {
            cursor: not-allowed;
            box-shadow: none;
            opacity: 0.3;
        }

        .oc-export-btn:hover,.oc-export-btn:focus,.oc-export-btn:active  {
            background-color: #449d44;
            border-color: #347a34;
        }

        .orgchart~.mask {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 999;
            text-align: center;
            background-color: rgba(0,0,0,0.3);
        }

        .orgchart~.mask .spinner {
            position: absolute;
            top: calc(50% - 54px);
            left: calc(50% - 54px);
            color: rgba(255,255,255,0.8);
            font-size: 108px;
        }

        .orgchart .node {
            transition: transform 0.3s, opacity 0.3s;
        }

        .orgchart .slide-down {
            opacity: 0;
            transform: translateY(40px);
        }

        .orgchart.l2r .node.slide-down, .orgchart.r2l .node.slide-down {
            transform: translateY(130px);
        }

        .orgchart .slide-up {
            opacity: 0;
            transform: translateY(-40px);
        }

        .orgchart.l2r .node.slide-up, .orgchart.r2l .node.slide-up {
            transform: translateY(-130px);
        }

        .orgchart .slide-right {
            opacity: 0;
            transform: translateX(130px);
        }

        .orgchart.l2r .node.slide-right, .orgchart.r2l .node.slide-right {
            transform: translateX(40px);
        }

        .orgchart .slide-left {
            opacity: 0;
            transform: translateX(-130px);
        }

        .orgchart.l2r .node.slide-left, .orgchart.r2l .node.slide-left {
            transform: translateX(-40px);
        }
    </style>
    <style type="text/css">
        /*   #chart-container {
               height: 600px;
               border: 2px solid #aaa;
           }*/





        #chart-container {
            position: relative;
            display: inline-block;
            top: 10px;
            left: 10px;
            height: 600px;
            width: calc(100% - 24px);
            border: 2px dashed #aaa;
            border-radius: 5px;
            overflow: auto;
            text-align: center;
        }
    </style>
@stop
@section('content')
    <div class="col-md-6 col-sm-6 col-xs-4">
        <h3>
            @lang('master.Company Group structure')

        </h3>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-8">
        <ul class="nav navbar-right panel_toolbox">

            <li><a class="btn btn-app" href="{!! route('counterparties.index') !!}">
                    <i class="glyphicon glyphicon-arrow-left"></i> Back
                </a>
            </li>
        </ul>
    </div>
    <div id="chart-container">
        <div id="show_info"><p></p></div>
    </div>

@stop

@section('javascript')

    <script type="text/javascript" src="/app/js/vendor/orgchart/jquery.orgchart.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function () {



            var datascource = {<?php echo $attr; ?>};
            var nodeTemplate = function(data) {
                return `
    <span class="content" style="visibility:hidden;">${data.id}</span>
    <div class="title">${data.short_name}</div>
    <div class="country">(${data.country})</div>
  `;
            };

            if (Object.keys(datascource['children']).length>20) {

                var oc = $('#chart-container').orgchart({

                    'visibleLevel':1,
                    'data': datascource,
                    'nodeContent': 'id',
                    'nodeTitle':'name',
                    'draggable': true,
                    'nodeTemplate': nodeTemplate,


                });

            }else {
                var oc = $('#chart-container').orgchart({
                    'data': datascource,
                    'nodeContent': 'id',
                    'nodeTitle':'name',
                    'draggable': true,
                    'nodeTemplate': nodeTemplate,

                });
            }



            oc.$chart.on('nodedrop.orgchart', function (event, extraParams) {
                console.log('draggedNode:' + extraParams.draggedNode.children('.content').text()
                    + ', dropZone:' + extraParams.dropZone.children('.content').text()
                );

                var data = {"companyId": extraParams.draggedNode.children('.content').text(), "parentCompanyId": extraParams.dropZone.children('.content').text(),"_token": "{{ csrf_token() }}",};
                console.log(data);
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: '/assign/parent-company'
                });
            });

        });
    </script>



@stop