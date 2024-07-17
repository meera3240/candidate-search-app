<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .user-card {
            margin-bottom: 20px;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Search </h2>
    <div class="row mb-3">
        <div class="col-md-12">
            <input type="text" id="search" class="form-control" placeholder="Search Name/Department/Designation">
        </div>
    </div>

    <div class="row" id="user-cards">
        <!-- User cards will be populated by jQuery -->
    </div>
</div>

<script>
    $(document).ready(function() {
        function fetchUsers() {
            var search = $('#search').val();

            $.ajax({
                url: '/',
                type: 'GET',
                data: { search: search },
                success: function(data) {
                    $('#user-cards').empty();
                    $.each(data, function(index, user) {
                        var cardHtml = `
                        <div class="col-md-4">
                            <div class="card user-card">
                                <div class="card-body">
                                    <h5 class="card-title">${user.name}</h5>
                                    <p class="card-text">${user.department_name}</p>
                                    <p class="card-text">${user.designation_name}</p>
                                </div>
                            </div>
                        </div>
                    `;
                        $('#user-cards').append(cardHtml);
                    });
                }
            });
        }

        $('#search').on('keyup', function() {
            fetchUsers();
        });

        // Initial fetch
        fetchUsers();
    });
</script>
</body>
</html>
