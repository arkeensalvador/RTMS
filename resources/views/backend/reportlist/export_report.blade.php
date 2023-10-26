<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <title>RTMS - Report</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .table-area .notices {
            padding-left: 6px;
            padding: 10px;
        }

        thead {
            color: #fff;
            font-weight: 200;
            font-size: 20px;
        }

        .table td,
        .table th {
            text-align: center;
            vertical-align: middle;
            font-size: 14px;
        }

        .report-footer {
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        /* .page {
            background: var(--white);
            display: block;
            margin: 0 auto;
            position: relative;
            box-shadow: var(--pageShadow);
        }

        .page[size="A4"] {
            width: 21cm;
            overflow: hidden;
        } */
    </style>
</head>

<body>
    <div class="my-5 page" size="A4">
        <section class="top-content page-header d-flex justify-content-center"
            style=" border-bottom: 3px solid rgb(194, 194, 194);">
            <div class="logo">
                <p class="text-center">
                    <img src="https://i.ibb.co/6Yp32Y5/Report-Logo.png" alt="" class="img-fluid d-block"
                        style="height: 70px; margin: 0 auto;">
                </p>
            </div>
        </section>


        <!-- R&D Management and Coordination -->
        <section class="table-area mt-4 page-break">

            <div class="table-title col-12 py-1"
                style="background-image: url('https://i.ibb.co/Jp0tJxt/sec1.webp'); background-size:cover;;">
                <h1 class="text-center text-capitalized font-weight-bold"
                    style="color: #fff; text-shadow: 1px 1px 2px #1b1b1b; letter-spacing: -1px; ">RESEARCH AND
                    DEVELOPMENT<br>MANAGEMENT AND COORDINATION</h1>
            </div>


            <!-- Summary of the AIHR's conducted by the CMI's -->
            <div class="category my-5">
                <div class="notices mb-1 " style="border-left: 6px solid #0DA603;">
                    <h5>Summary of the <span class="font-weight-bold" style=" color: #0DA603;">AIHR's conducted by
                            the CMI's</span></h5>
                </div>

                <table class="table-bordered table table-hover">
                    <thead style="background-color: #0DA603;">
                        <tr>
                            <td rowspan="2">Agency</td>
                            <td colspan="4">Number of Project Presented</td>

                        </tr>
                        <tr>
                            <td style="width: 25%;">New</td>
                            <td>Ongoing</td>
                            <td>Completed</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>TAU</td>
                            <td>4</td>
                            <td>17</td>
                            <td>9</td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- PROJECTS -->
            <div class="category my-5">
                <div class="notices mb-1 " style="border-left: 6px solid #0DA603;">
                    <h5>List of <span class="font-weight-bold" style=" color: #0DA603;">Project</span></h5>
                </div>
                <table class="table-bordered table table-hover">
                    <thead style="background-color: #0DA603;">
                        <tr>
                            <td>Project Title</td>
                            <td>Description</td>
                            <td>Duration</td>
                            <td>Funding Agency</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plist as $pl)
                            <tr>
                                <td>{{ $pl->project_title }}</td>
                                <td>{{ $pl->project_description }}</td>
                                <td>
                                    {{ date('m/d/Y', strtotime($pl->project_start_date)) ?: 'Not Set' }} -
                                    {{ date('m/d/Y', strtotime($pl->project_end_date)) ?: 'Not Set' }}
                                </td>
                                <td>{{ $pl->project_agency }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- PROGRAMS -->
            <div class="category my-5">
                <div class="notices mb-1 " style="border-left: 6px solid #0DA603;">
                    <h5>List of <span class="font-weight-bold" style=" color: #0DA603;">Program</span></h5>
                </div>
                <table class="table-bordered table table-hover">
                    <thead style="background-color: #0DA603;">
                        <tr>
                            <td>Program Title </td>
                            <td>Description</td>
                            <td>Duration</td>
                            <td>Funding Agency</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $data)
                            <tr>
                                <td>{{ $data->program_title }}</td>
                                <td>{{ $data->program_description }}</td>
                                <td>
                                    {{ date('m/d/Y', strtotime($data->start_date)) ?: 'Not Set' }} -
                                    {{ date('m/d/Y', strtotime($data->end_date)) ?: 'Not Set' }}
                                </td>
                                <td>{{ $data->funding_agency }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- SUB-PROJECTS -->
            <div class="category my-5">
                <div class="notices mb-1 " style="border-left: 6px solid #0DA603;">
                    <h5>List of <span class="font-weight-bold" style=" color: #0DA603;">Sub-Project</span></h5>
                </div>
                <table class="table-bordered table table-hover">
                    <thead style="background-color: #0DA603;">
                        <tr>
                            <td>Sub-Project Title </td>
                            <td>Description</td>
                            <td>Duration</td>
                            <td>Funding Agency</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($splist as $spl)
                            <tr>
                                <td>{{ $spl->sub_project_title }}</td>
                                <td>{{ $spl->sub_project_description }}</td>
                                <td>
                                    {{ date('m/d/Y', strtotime($spl->sub_project_start_date)) ?: 'Not Set' }} -
                                    {{ date('m/d/Y', strtotime($spl->sub_project_end_date)) ?: 'Not Set' }}
                                </td>
                                <td>{{ $spl->sub_project_agency }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Linkages forged and maintained -->
            <div class="category my-5">
                <div class="notices mb-1 " style="border-left: 6px solid #0DA603;">
                    <h5><span class="font-weight-bold" style=" color: #0DA603;">Linkages forged</span> and <span
                            class="font-weight-bold" style=" color: #0DA603;">maintained</span> </h5>
                </div>
                <table class="table-bordered table table-hover">
                    <thead style="background-color: #0DA603;">
                        <tr>
                            <td>Agency/Institutions</td>
                            <td>Address</td>
                            <td>Year</td>
                            <td>Nature of Assistance / Linkages /Projects</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" style="background: #d3ffd1;" class="font-weight-bold">DEVELOPED/NEW
                            </td>
                        </tr>
                        @foreach ($linkages_developed as $ld)
                            <tr>
                                <td>{{ $ld->form_of_development }}</td>
                                <td>{{ $ld->address }}</td>
                                <td>{{ $ld->year }}</td>
                                <td>
                                    {{ $ld->nature_of_assistance }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" style="background: #d3ffd1;" class="font-weight-bold">
                                MAINTAINED/SUSTAINED</td>
                        </tr>

                        @foreach ($linkages_maintained as $lm)
                            <tr>
                                <td>{{ $lm->form_of_development }}</td>
                                <td>{{ $lm->address }}</td>
                                <td>{{ $lm->year }}</td>
                                <td>
                                    {{ $lm->nature_of_assistance }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- List of database developed/enhanced and maintained.-->
            <div class="category my-5">
                <div class="notices mb-1 " style="border-left: 6px solid #0DA603;">
                    <h5>List of<span class="font-weight-bold" style=" color: #0DA603;"> Database
                            developed/enhanced</span> and <span class="font-weight-bold"
                            style=" color: #0DA603;">maintained</span> </h5>
                </div>
                <table class="table-bordered table table-hover">
                    <thead style="background-color: #0DA603;">
                        <tr>
                            <td>Title</td>
                            <td>Type of Database</td>
                            <td>Database Created</td>
                            <td>Purpose / Use</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($db as $db)
                            <tr>
                                <td>{{ $db->dbinfosys_title }}</td>
                                <td>{{ $db->dbinfosys_category }}</td>
                                <td>{{ $db->dbinfosys_date_created }}</td>
                                <td>{{ $db->dbinfosys_purpose }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- List of information system developed/enhanced and maintained.-->
            <div class="category my-5">
                <div class="notices mb-1 " style="border-left: 6px solid #0DA603;">
                    <h5>List of<span class="font-weight-bold" style=" color: #0DA603;"> Information System
                            developed/enhanced</span> and <span class="font-weight-bold"
                            style=" color: #0DA603;">maintained</span> </h5>
                </div>
                <table class="table-bordered table table-hover">
                    <thead style="background-color: #0DA603;">
                        <tr>
                            <td>Title</td>
                            <td>Type of Database</td>
                            <td>Database Created</td>
                            <td>Purpose / Use</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($is as $is)
                            <tr>
                                <td>{{ $is->dbinfosys_title }}</td>
                                <td>{{ $is->dbinfosys_category }}</td>
                                <td>{{ $is->dbinfosys_date_created }}</td>
                                <td>{{ $is->dbinfosys_purpose }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </section>

        <!-- Strategic Research & Development Activities -->
        <section class="table-area mt-4 page-break">


            <div class="table-title col-12 py-1"
                style="background-image: url('https://i.ibb.co/MpcC8d4/sec2.webp'); background-size:cover;">
                <h1 class="text-center text-capitalized font-weight-bold"
                    style="color: #fff; text-shadow: 1px 1px 2px #1b1b1b; letter-spacing: -1px; ">STRATEGIC
                    RESEARCH AND <br>DEVELOPMENT ACTIVITIES</h1>
            </div><br>

            <!-- List of R&D Programs/Projects Packaged, Approved and Implemented,CY 2022 -->
            <div class="category my-5">
                <div class="notices mb-1 " style="border-left: 6px solid #002E94;">
                    <h5>List of <span class="font-weight-bold" style="color:#002E94;">Research & Development
                            Programs/Projects Packaged, Approved </span>and <span class="font-weight-bold"
                            style="color:#002E94;">Implemented</span></h5>
                </div>
                <table class="table-bordered table table-hover">
                    <thead style="background-color: #002E94;">
                        <tr>
                            <td>Program / Project Title</td>
                            <td>Implementing Agency</td>
                            <td>Duration</td>
                            <td>Source of Funds</td>
                            <td>Budget</td>
                            <td>Regional Priority / Commodity Addressed</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" style="background: #ddffff; color: black;" class="font-weight-bold">
                                PROPOSALS PACKAGED</td>
                        </tr>
                        <tr>
                            <td>Molecular Marker Assisted Selection of Resistant Onion combined with GMO-free
                                silencing the Anthracnose-Twister Disease </td>
                            <td>CLSU</td>
                            <td>2 years</td>
                            <td>PCAARRD</td>
                            <td>5,226,969.00</td>
                            <td>Onion</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="background: #ddffff; color: black;" class="font-weight-bold">
                                PROJECTS APPROVED AND IMPLEMENTED</td>
                        </tr>
                        <tr>
                            <td>Molecular Marker Assisted Selection of Resistant Onion combined with GMO-free
                                silencing the Anthracnose-Twister Disease </td>
                            <td>CLSU</td>
                            <td>2 years</td>
                            <td>PCAARRD</td>
                            <td>5,226,969.00</td>
                            <td>Onion</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Collaborative R&D Programs/Projects Implemented by the Consortium and Member-Agencies in support of regional priorities. -->
            <div class="category my-5">
                <div class="notices mb-1 " style="border-left: 6px solid #002E94;">
                    <h5 class=" text-left">Collaborative <span class="font-weight-bold"
                            style="color:#002E94;">Research & Development Programs/Projects Implemented </span> by
                        the <span class="font-weight-bold" style="color:#002E94;"> Consortium
                        </span> and <span class="font-weight-bold" style="color:#002E94;">Member-Agencies in
                            support of regional priorities</span></h5>
                </div>

                <table class="table-bordered table table-hover" style="font-size: 5px;">
                    <thead style="background-color: #002E94;">
                        <tr>
                            <td>Program Title</td>
                            <td>Project Title</td>
                            <td>Implementing Agency <br>/ Institution</td>
                            <td>Duration</td>
                            <td>Budget</td>
                            <td>Source(s) of Fund</td>
                            <td>Role of Consortium</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Accelerated R&D Program for Capacity Building of Research and Development
                                Institutions and Industrial Competitiveness: Niche Centers in the Regions for R&D
                                (Nicer) Program: Sweet Potato R&D Center</td>
                            <td>Optimization of Sweet potato Clean Planting Materials (SP CPM) Production in Central
                                Luzon</td>
                            <td>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">TAU</li>
                                    <li class="list-group-item">CLSU</li>
                                    <li class="list-group-item">PRMSU</li>
                                </ul>
                            </td>
                            <td>October 2019 – March 2022</td>
                            <td>25,000,000.00</td>
                            <td>DOST PCAARRD</td>
                            <td>Lead Program Implementor</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- 9. List of Technologies/ Information Generated from R&D, CY 2022 -->
            <div class="category my-5">
                <div class="notices mb-1 " style="border-left: 6px solid #002E94;">
                    <h5 class=" text-left">List of <span class="font-weight-bold"
                            style="color:#002E94;">Technologies/ Information </span> Generated from <span
                            class="font-weight-bold" style="color:#002E94;"> Research and Development
                        </span></h5>
                </div>

                <table class="table-bordered table table-hover" style="font-size: 5px;">
                    <thead style="background-color: #002E94;">
                        <tr>
                            <td>Title of Technology</td>
                            <td>Agency</td>
                            <td>Researcher(s)</td>
                            <td>Potential Impact or Contribution</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" style="background: #ddffff; color: black;" class="font-weight-bold">
                                RESEARCH</td>
                        </tr>
                        <tr>
                            <td>Accelerated R&D Program for Capacity Building of Research and Development
                                Institutions and Industrial Competitiveness: Niche Centers in the Regions for R&D
                                (Nicer) Program: Sweet Potato R&D Center</td>
                            <td>Optimization of Sweet potato Clean Planting Materials (SP CPM) Production in Central
                                Luzon</td>
                            <td>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">TAU</li>
                                    <li class="list-group-item">CLSU</li>
                                    <li class="list-group-item">PRMSU</li>
                                </ul>
                            </td>
                            <td>
                                A modified FNA-based biosensor was developed at CLSU to determine the presence of
                                pathogens. The device can be a decision tool for stakeholders to discard the rice
                                seeds or provide treatment before storage banking and quarantine. In addition, the
                                biosensor could avoid the risk of planting infected seeds and introducing and
                                spreading the disease across fields.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="background: #ddffff; color: black;" class="font-weight-bold">
                                DEVELOPMENT</td>
                        </tr>
                        <tr>
                            <td>Soft-boned Milkfish Products: Livelihood Opportunities for the Marginalized Members
                                of the Community</td>
                            <td>BPSU</td>
                            <td style="width: 30%;">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Mark Nell Corpuz</li>
                                    <li class="list-group-item">MF Damaso, Marz</li>
                                    <li class="list-group-item">Linnaeous L.</li>
                                    <li class="list-group-item">Rabnadon, Adrian</li>
                                    <li class="list-group-item">Dale Manliclic</li>
                                    <li class="list-group-item">Christian Romero</li>
                                </ul>
                            </td>
                            <td>
                                A modified FNA-based biosensor was developed at CLSU to determine the presence of
                                pathogens. The device can be a decision tool for stakeholders to discard the rice
                                seeds or provide treatment before storage banking and quarantine. In addition, the
                                biosensor could avoid the risk of planting infected seeds and introducing and
                                spreading the disease across fields.
                            </td>
                        </tr>
                    </tbody>
                </table>



            </div>

        </section>

        <!-- R & D Results Utilization-->
        <section class="table-area mt-4 page-break">

            <div class="table-title col-12 py-1"
                style="background-image: url('https://i.ibb.co/0Z2VpgB/sec3.webp'); background-size:cover;;">
                <h1 class="text-center text-capitalized font-weight-bold"
                    style="color: #fff; text-shadow: 1px 1px 2px #1b1b1b; letter-spacing: -1px; ">RESEARCH AND
                    DEVELOPMENT<br>RESULTS UTILIZATION</h1>
            </div>

            <!-- Data from "Technology Transfer Proposals -->
            <div class="category my-5">
                <div class="notices mb-1 " style="border-left: 6px solid #3D30A2;">
                    <h5>List of <span class="font-weight-bold" style="color:#3D30A2;"> Technology Transfer
                            Program/Projects Packaged, Approved </span>and <span class="font-weight-bold"
                            style="color:#002E94;">Implemented</span></h5>
                </div>

                <table class="table-bordered table table-hover">
                    <thead style="background-color: #3D30A2;">
                        <tr>
                            <td>Program / Project Title</td>
                            <td>Proponent</td>
                            <td>Implementing Agency</td>
                            <td>Durataion</td>
                            <td>Source of Funds</td>
                            <td>Budget</td>
                            <td>Regional <br>Priority/ <br> Commodities <br> Addressed</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7" style="background: #DFCCFB; color: black;" class="font-weight-bold">
                                PROPOSALS PACKAGED</td>
                        </tr>
                        <tr>
                            <td>Native Animals Fair</td>
                            <td>PCAARRD</td>
                            <td>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">TAU</li>
                                    <li class="list-group-item">CLSU</li>
                                    <li class="list-group-item">PRMSU</li>
                                </ul>
                            </td>
                            <td>01/02/2020 - 09/20/2023</td>
                            <td>PCAARRD</td>
                            <td>4,690,222</td>
                            <td>Livestock - Itik Pinas</td>
                        </tr>
                        <tr>
                            <td colspan="7" style="background: #DFCCFB; color: black;" class="font-weight-bold">
                                PROJECTS APPROVED AND IMPLEMENTED</td>
                        </tr>
                        <tr>
                            <td>Let’s Doe Business: A Livelihood Opportunity in Response to COVID 19 Pandemic for
                                Small hold Farms through Production of Dairy Goats</td>
                            <td>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Mark Nell Corpuz</li>
                                    <li class="list-group-item">MF Damaso, Marz</li>
                                    <li class="list-group-item">Linnaeous L.</li>
                                </ul>
                            </td>
                            <td>CLSU</td>
                            <td>01/02/2020 - 09/20/2023</td>
                            <td>PCAARRD</td>
                            <td>4,690,222</td>
                            <td>Goat</td>
                        </tr>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!--  Data from "Technology Transfer Modalities-->
            <div class="category my-5">
                <div class="notices mb-1 " style="border-left: 6px solid #3D30A2;">
                    <h5>List of <span class="font-weight-bold" style="color:#3D30A2;"> Technologies Commercialized
                        </span>or <span class="font-weight-bold" style="color:#002E94;">Pre-Commercialization
                            Initiatives</span></h5>
                </div>

                <table class="table-bordered table table-hover">
                    <thead style="background-color: #3D30A2;">
                        <tr>
                            <td>Type of IPR Applies</td>
                            <td>Technologies</td>
                            <td>Agency</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Copyright</td>
                            <td>CLSU Special Purpose Rice </td>
                            <td>CLSU</td>
                            <td>Application No. O2022-66 / March 2, 2022</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!--  Data from "Technology Promotion Approches-->
            <div class="category my-5">
                <div class="notices mb-1 " style="border-left: 6px solid #3D30A2;">
                    <h5>List of <span class="font-weight-bold" style="color:#3D30A2;">Technology Promotion
                            Approaches </span></h5>
                </div>
                <table class="table-bordered table table-hover">
                    <thead style="background-color: #3D30A2;">
                        <tr>
                            <td>Technology Promotion Approaches </td>
                            <td>Title</td>
                            <td>Remarks</td>
                            <td>Details</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Regional FIESTA</td>
                            <td>Smart Farming was presented during the Veggie FIESTA on technology pitching</td>
                            <td>CLSU</td>
                            <td>Lorem Ipsum </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </section>

        <!-- Capability Building and Governance-->
        <section class="table-area mt-4 page-break">

            <div class="table-title col-12 py-1"
                style="background-image: url('https://i.ibb.co/NCMBtB8/sec4.webp'); background-size:cover;;">
                <h1 class="text-center text-capitalized font-weight-bold"
                    style="color: #fff; text-shadow: 1px 1px 2px #1b1b1b; letter-spacing: -1px; ">CAPABILITY
                    BUILDING<br>AND GOVERNANCE</h1>
            </div>

            <!-- Data from "Trainings-Workshop" -->
            <div class="category my-5">
                <div class="notices mb-1 " style="border-left: 6px solid #FF8400;">
                    <h5>List of <span class="font-weight-bold" style="color:#FF8400;"> non-degree trainings
                            conducted/facilitated </span></h5>
                </div>
                <table class="table-bordered table table-hover">
                    <thead style="background-color: #FF8400;">
                        <tr>
                            <td>Title of Activity</td>
                            <td>Date</td>
                            <td>Venue</td>
                            <td>Number of Participants</td>
                            <td>Expenditures</td>
                            <td>Source(s) of Funds</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Training Workshop on Social Media (SocMed) Management and Content Development</td>
                            <td>March 17 - 18, 2022</td>
                            <td>CLSU</td>
                            <td>30</td>
                            <td>N/A</td>
                            <td>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">PCAARRD</li>
                                    <li class="list-group-item">CLAARRDEC</li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Equipments and Facilities" -->
            <div class="category my-5">
                <div class="notices mb-1 " style="border-left: 6px solid #FF8400;">
                    <h5><span class="font-weight-bold" style="color:#FF8400;">Equipment</span> and <span
                            class="font-weight-bold" style="color:#FF8400;">Facilities
                            Established/Installed/Acquired/Funded</span></h5>
                </div>
                <table class="table-bordered table table-hover">
                    <thead style="background-color: #FF8400;">
                        <tr>
                            <td class="text-center">Equipment/ <br>Facilities Established<br>/Upgraded/<br>Approved
                            </td>
                            <td>Name of Equipment</td>
                            <td>Agency</td>
                            <td>Expenditures</td>
                            <td>Source(s) of Funds</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Facilities Established</td>
                            <td>Construction of BASC Swine Multiplier & Technodemo Farm</td>
                            <td>BSAC</td>
                            <td>126, 950.00</td>
                            <td>DA-BAYANIHAN 2</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Awards Received" -->
            <div class="category my-5">
                <div class="notices mb-1 " style="border-left: 6px solid #FF8400;">
                    <h5><span class="font-weight-bold" style="color:#FF8400;">Awards Received</span> by the<span
                            class="font-weight-bold" style="color:#FF8400;"> consortium </span> or <span
                            class="font-weight-bold" style="color:#FF8400;"> member-agencies</span></h5>
                </div>
                <table class="table-bordered table table-hover">
                    <thead style="background-color: #FF8400;">
                        <tr>
                            <td class="text-center">Type of Award</td>
                            <td>Title</td>
                            <td>Recipient/Agency</td>
                            <td>Sponsor</td>
                            <td>Event/Activity</td>
                            <td>Place of Award</td>
                            <td>Date</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>REGIONAL</td>
                            <td>Awards Title Sample</td>
                            <td>Health Beyond Bars and Community-Based Rice Mushroom Production/BPSU</td>
                            <td>Civil Service Commission</td>
                            <td>CSC 2022 Honor Awards Programs</td>
                            <td>San Fernando, Pampanga</td>
                            <td>September 6, 2022</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </section>

        <div class="report-footer mt-5">
            <p class="text-center">
                This is generated report from <span class="text-success">CLAARDEC Real-Time Monitoring
                    System</span><br>
                <span class="mx-1 sm"><i class="fas fa-mobile-alt mx-1 text-success"></i>0945 498 6941</span>
                <span class="mx-1 sm"><i class="fas fa-envelope mx-1 text-success"></i>claardec@clsu.edu.ph</span>
                <span class="mx-1 sm"><i
                        class="fas fa-globe mx-1 text-success"></i></i>www.rtms.claarrdec.gov.ph</span>
            </p>
        </div>
    </div>
</body>
<script>
    const displayTime = document.querySelector(".display-time");
    // Time
    function showTime() {
        let time = new Date();
        displayTime.innerText = time.toLocaleTimeString("en-US", {
            hour12: true
        });
        setTimeout(showTime, 1000);
    }

    showTime();

    // Date
    function updateDate() {
        let today = new Date();

        // return number
        let dayName = today.getDay(),
            dayNum = today.getDate(),
            month = today.getMonth(),
            year = today.getFullYear();

        const months = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ];
        const dayWeek = [
            "Sunday",
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
        ];
        // value -> ID of the html element
        const IDCollection = ["day", "daynum", "month", "year"];
        // return value array with number as a index
        const val = [dayWeek[dayName], dayNum, months[month], year];
        for (let i = 0; i < IDCollection.length; i++) {
            document.getElementById(IDCollection[i]).firstChild.nodeValue = val[i];
        }
    }

    updateDate();
</script>

</html>
