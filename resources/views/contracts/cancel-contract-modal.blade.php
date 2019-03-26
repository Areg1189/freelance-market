<div class="login-modal job-post-modal d-flex align-items-center justify-content-center" id="cancel-contract">
    <div class="bg"></div>
    <div class="inner-modal w-50 py-0 position-relative px-3">
        <div class="panel-footer">
            <h4>Select a reason for cancellation.</h4>
            <form action="{{route('contract.closed', ['from' => $from, 'contract' => $contract->id])}}"
                  method="POST"
                  class="cancel-job-form">
                @csrf
                <div class="radio">
                    <label>
                        <input type="radio" class="cancel-reason"
                                  name="close"
                                  value="What is Lorem Ipsum?">
                        What is Lorem Ipsum?
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" class="cancel-reason" value="Where does it come from?" name="close">
                        Where does it come from?
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" class="cancel-reason" value="Where can I get some?" name="close">
                        Where can I get some?
                    </label>
                </div>
                <div class="radio">
                    <textarea id="message-body" class="other-text" name="message" rows="2"  required></textarea>
                </div>
                <button type="submit"
                        class="own-btn">
                    cancel contract
                </button>
            </form>
        </div>
    </div>
</div>