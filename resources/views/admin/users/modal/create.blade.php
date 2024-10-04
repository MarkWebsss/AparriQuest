<form action="{{ route('business.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Register New Shop') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-2">
                    <!-- Applicant Section -->
                    <div class="row">
                        <div class="card w-100">
                            <h5 class="card-header text-center">Applicant</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="firstName">First Name:</label>
                                            <input type="text" class="form-control" name="firstName" id="firstName" required placeholder="Enter First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="middleName">Middle Name:</label>
                                            <input type="text" class="form-control" name="middleName" id="middleName" placeholder="Enter Middle Initial">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lastName">Last Name:</label>
                                            <input type="text" class="form-control" name="lastName" id="lastName" required placeholder="Enter Last Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ownerHouseNo">House No.:</label>
                                            <input type="text" class="form-control" name="ownerHouseNo" id="ownerHouseNo" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ownerStreetAddress">Street Address:</label>
                                            <input type="text" class="form-control" name="ownerStreetAddress" id="ownerStreetAddress" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ownerProvinceCity">Province/City:</label>
                                            <input type="text" id="autocompleteInput" name="ownerCity" class="form-control" placeholder=""
                                        oninput="showSuggestions()" list="suggestions">
                                        <datalist id="suggestions">
                                            <option value="Abulug">
                                            <option value="Alcala">
                                            <option value="Allacapan">
                                            <option value="Amulung">
                                            <option value="Aparri">
                                            <option value="Baggao">
                                            <option value="Ballesteros">
                                            <option value="Buguey">
                                            <option value="Calayan">
                                            <option value="Camalaniugan	">
                                            <option value="Claveria">
                                            <option value="Enrile">
                                            <option value="Gattaran">
                                            <option value="Gonzaga">
                                            <option value="Iguig">
                                            <option value="Lal-lo">
                                            <option value="Lasam">
                                            <option value="Pamplona">
                                            <option value="Peñablanca">
                                            <option value="Piat">
                                            <option value="Rizal">
                                            <option value="Sanchez-Mira">
                                            <option value="Santa Ana">
                                            <option value="Santa Praxedes">
                                            <option value="Santa Teresita">
                                            <option value="Santo Niño">
                                            <option value="Solana">
                                            <option value="Tuao">
                                            <option value="Tuguegarao City">
                                        </datalist>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ownerEmail">Owner Email:</label>
                                            <input type="email" class="form-control" name="ownerEmail" id="ownerEmail" required placeholder="eg. name@gmail.com">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ownerPhone">Owner Phone Number:</label>
                                            <input type="tel" class="form-control" name="ownerPhone" id="ownerPhone" required placeholder="eg. 09xxxxxxxxx">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dateOfApplication">Date of Application:</label>
                                            <input type="date" class="form-control" name="dateOfApplication" id="dateOfApplication" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Business Details Section -->
                    <div class="row mt-3">
                        <div class="card w-100">
                            <h5 class="card-header text-center">Business Details</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="businessName">Business Name:</label>
                                            <input type="text" class="form-control" name="businessName" id="businessName" required placeholder="Enter the Business Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tinNumber">Tin Number:</label>
                                            <input type="text" class="form-control" name="tinNumber" id="tinNumber" required placeholder="Enter Tin Number">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="houseNo">Business No.:</label>
                                            <input type="text" class="form-control" name="businessNo" id="businessNo" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="streetAddress">Street Address:</label>
                                            <input type="text" class="form-control" name="BusStreetAddress" id="BusStreetAddress" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="suggestions">Province/City:</label>
                                        <input type="text" id="autocompleteInput" name="businessCity" class="form-control" placeholder=""
                                        oninput="showSuggestions()" list="suggestions">
                                        <datalist id="suggestions">
                                            <option value="Abulug">
                                            <option value="Alcala">
                                            <option value="Allacapan">
                                            <option value="Amulung">
                                            <option value="Aparri">
                                            <option value="Baggao">
                                            <option value="Ballesteros">
                                            <option value="Buguey">
                                            <option value="Calayan">
                                            <option value="Camalaniugan	">
                                            <option value="Claveria">
                                            <option value="Enrile">
                                            <option value="Gattaran">
                                            <option value="Gonzaga">
                                            <option value="Iguig">
                                            <option value="Lal-lo">
                                            <option value="Lasam">
                                            <option value="Pamplona">
                                            <option value="Peñablanca">
                                            <option value="Piat">
                                            <option value="Rizal">
                                            <option value="Sanchez-Mira">
                                            <option value="Santa Ana">
                                            <option value="Santa Praxedes">
                                            <option value="Santa Teresita">
                                            <option value="Santo Niño">
                                            <option value="Solana">
                                            <option value="Tuao">
                                            <option value="Tuguegarao City">
                                        </datalist>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="businessEmail">Business Email:</label>
                                            <input type="email" class="form-control" name="businessEmail" id="businessEmail" required placeholder="eg. name@gmail.com">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="businessPhone">Business Phone Number:</label>
                                            <input type="tel" class="form-control" name="businessPhone" id="businessPhone" required placeholder="eg. 09xxxxxxxxx">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center mt-3">
                        <input type="submit" class="btn btn-primary" value="Register">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showSuggestions() {
    const input = document.getElementById('autocompleteInput');
    const datalist = document.getElementById('suggestions');

    // Check if the input is not empty
    if (input.value.length > 0) {
        // Show the datalist
        datalist.size = 5; // Change size to display more options
    } else {
        // Hide the datalist
        datalist.size = 0; // Hide the dropdown
    }
}
    </script>
</form>


