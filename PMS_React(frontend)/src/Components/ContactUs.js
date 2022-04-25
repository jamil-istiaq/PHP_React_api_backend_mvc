import React from 'react'

export default function ContactUs() {
    return (
        <div>
            <section className="content-header">
                <div className="container-fluid">
                    <div className="row mb-2">
                        <div className="col-sm-6">
                            <h1>Contact Us</h1>
                        </div>
                    </div>
                </div>
            </section>
            <section className="content">
                <div className="card">
                    <div className="card-body row">
                        <div className="col-5 text-center d-flex align-items-center justify-content-center">
                            <div className>
                                <h2><strong>Project Management System</strong></h2>
                                <p className="lead mb-5">PMS</p>
                            </div>
                        </div>
                        <div className="col-7">
                            <div className="form-group">
                                <label htmlFor="inputName">Name</label>
                                <input type="text" id="inputName" className="form-control" />
                            </div>
                            <div className="form-group">
                                <label htmlFor="inputEmail">E-Mail</label>
                                <input type="email" id="inputEmail" className="form-control" />
                            </div>
                            <div className="form-group">
                                <label htmlFor="inputSubject">Subject</label>
                                <input type="text" id="inputSubject" className="form-control" />
                            </div>
                            <div className="form-group">
                                <label htmlFor="inputMessage">Message</label>
                                <textarea id="inputMessage" className="form-control" rows={4} defaultValue={""} />
                            </div>
                            <div className="form-group">
                                <input type="submit" className="btn btn-primary" defaultValue="Send message" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    )
}