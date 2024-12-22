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
                                            <select class="form-control" name="ownerStreetAddress" id="ownerStreetAddress" required>
                                                <option value="" disabled selected>Select Street Address</option>
                                                <option value="Alvarado Street">Alvarado Street</option>
                                                <option value="Balisi Street">Balisi Street</option>
                                                <option value="Ballesteros Street">Ballesteros Street</option>
                                                <option value="Bonifacio Street">Bonifacio Street</option>
                                                <option value="De Carreon Street">De Carreon Street</option>
                                                <option value="De Rivera Street">De Rivera Street</option>
                                                <option value="Del Pilar Street">Del Pilar Street</option>
                                                <option value="Diego Silang Street">Diego Silang Street</option>
                                                <option value="Doneza Street">Doneza Street</option>
                                                <option value="E. Jacinto Street">E. Jacinto Street</option>
                                                <option value="Enrile Street">Enrile Street</option>
                                                <option value="Loriga Gallarza Street">Loriga Gallarza Street</option>
                                                <option value="Luna Street">Luna Street</option>
                                                <option value="Mabini Street">Mabini Street</option>
                                                <option value="Magsaysay Street">Magsaysay Street</option>
                                                <option value="Quezon Street">Quezon Street</option>
                                                <option value="Quirino Street">Quirino Street</option>
                                                <option value="Rizal Street">Rizal Street</option>
                                                <option value="Roxas Street">Roxas Street</option>
                                                <option value="Magapit-Aparri Road">Magapit-Aparri Road</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ownerCity">Province/City:</label>
                                            <input type="text" id="autocompleteInput" name="ownerCity" class="form-control">
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
                                            <label for="businessName">Tin/Permit Number</label>
                                            <input type="text" class="form-control" name="tin_number" id="tin_number" required placeholder="Enter the Registered Tin/Permit Number">
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
                                            <select class="form-control" name="BusStreetAddress" id="BusStreetAddress" required>
                                                <option value="" disabled selected>Select Street Address</option>
                                                <option value="Alvarado Street">Alvarado Street</option>
                                                <option value="Balisi Street">Balisi Street</option>
                                                <option value="Ballesteros Street">Ballesteros Street</option>
                                                <option value="Bonifacio Street">Bonifacio Street</option>
                                                <option value="De Carreon Street">De Carreon Street</option>
                                                <option value="De Rivera Street">De Rivera Street</option>
                                                <option value="Del Pilar Street">Del Pilar Street</option>
                                                <option value="Diego Silang Street">Diego Silang Street</option>
                                                <option value="Doneza Street">Doneza Street</option>
                                                <option value="E. Jacinto Street">E. Jacinto Street</option>
                                                <option value="Enrile Street">Enrile Street</option>
                                                <option value="Loriga Gallarza Street">Loriga Gallarza Street</option>
                                                <option value="Luna Street">Luna Street</option>
                                                <option value="Mabini Street">Mabini Street</option>
                                                <option value="Magsaysay Street">Magsaysay Street</option>
                                                <option value="Quezon Street">Quezon Street</option>
                                                <option value="Quirino Street">Quirino Street</option>
                                                <option value="Rizal Street">Rizal Street</option>
                                                <option value="Roxas Street">Roxas Street</option>
                                                <option value="Magapit-Aparri Road">Magapit-Aparri Road</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="suggestions">Barangay</label>
                                            <input type="text" id="autocompleteInput" name="businessCity" class="form-control">
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
</form>


